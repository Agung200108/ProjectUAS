<?php

namespace App\Http\Livewire\Librarian\Book;

use Livewire\Component;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithFileUploads;  

class Table extends Component
{
    use WithPagination;
    use WithFileUploads;

    public  $title,
            $isbn,
            $author,
            $publisher,
            $responsible_person,
            $publication_year,
            $publication_place,
            $description,
            $edition,
            $gmd,
            $call_number,
            $language,
            $subject,
            $amount,
            $cover_file_name,
            $pdf_file_name;

    public $book_id;
    public $old_cover_file_name;
    public $old_pdf_file_name;
    public $isUpdate;
    public $showUploadPdf = false;
    public $isModal = 0;
    public $deleteId = false;
    public $search;
    public $page = 1;

protected $updatesQueryString = [
            ['page' => ['except' => 1]],
            ['search' => ['except' => '']],
        ];

    public function render()
    {
        if($this->gmd == "ebook"){
            $this->showUploadPdf = true;
        }else{
                $this->showUploadPdf = false;
            }

            $books = Book::latest()->simplePaginate(10);

            if ($this->search !== null) {
                $books = Book::where('title', 'like', '%' . $this->search . '%')
                                    ->latest()
                                    ->simplePaginate(10);
        }

        return view('livewire.librarian.book.table',[
            'books' => $books
        ]);
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function closeModal()
    {
        $this->isModal = false;
        $this->resetFields();
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function resetFields()
    {
        $this->title = '';
        $this->isbn = '';
        $this->author = '';
        $this->publisher = '';
        $this->publication_year = '';
        $this->publication_place = '';
        $this->responsible_person = '';
        $this->description = '';
        $this->edition = '';
        $this->gmd = '';
        $this->call_number = '';
        $this->language = '';
        $this->subject = '';
        $this->amount = '';
        $this->cover_file_name = '';
        $this->pdf_file_name = '';
        $this->book_id = '';
        $this->deleteId = false;
        $this->old_cover_file_name = '';
        $this->old_pdf_file_name = '';
        $this->showUploadPdf = false;
        $this->isUpdate = false;
    }

    public function store()
    {
        $imageValidation = '';
        $pdfValidation = '';

        if($this->cover_file_name != $this->old_cover_file_name){
            $imageValidation = "required|image|mimes:jpg,jpeg,png|max:1024";
        }

        if($this->gmd == "ebook"){
            if($this->pdf_file_name != $this->old_pdf_file_name){
                $pdfValidation = "required|mimes:pdf|max:10000";
            }
        }

        $this->validate([
            'title' => 'required|string',
            'isbn' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'responsible_person' => 'required',
            'publication_year' => 'required',
            'publication_place' => 'required',
            'description' => 'required',
            'gmd' => 'required',
            'language' => 'required',
            'subject' => 'required',
            'amount' => 'required',
            'cover_file_name' => $imageValidation,
            'pdf_file_name' => $pdfValidation,
        ]);

        if($this->cover_file_name != $this->old_cover_file_name){
            $coverFileName = $this->cover_file_name->store('coverbook');
        }else{
            $coverFileName = $this->cover_file_name;
        }

        $pdfFileName = "";
        if($this->gmd == "ebook"){
            if($this->pdf_file_name != $this->old_pdf_file_name){
                $pdfFileName = $this->pdf_file_name->store('ebook');
            }else{
                $pdfFileName = $this->pdf_file_name;
            }
        }


        if($this->isUpdate == true){
            DB::beginTransaction();

            try {
            Book::updateOrCreate(['id' => $this->book_id], [
                'title' => $this->title,
                'isbn' => $this->isbn,
                'author' => $this->author,
                'publisher' => $this->publisher,
                'responsible_person' => $this->responsible_person,
                'publication_year' => $this->publication_year,
                'publication_place' => $this->publication_place,
                'description' => $this->description,
                'edition' => $this->edition,
                'gmd' => $this->gmd,
                'call_number' => $this->call_number,
                'language' => $this->language,
                'subject' => $this->subject,
                'amount' => $this->amount,
                'cover_file_name' => $coverFileName,
                'pdf_file_name' => $pdfFileName,
            ]);

            DB::commit();
            // all good
            } catch (Exception $e) {
                DB::rollback();
                session()->flash('errMessage', 'failed to change, please try again');
                $this->closeModal(); 
                $this->resetFields();
                exit; 
            }
        }else{
            if($this->checkIsbn($this->isbn) == false){
                session()->flash('errMessage',$this->title . ' sudah pernah ditambahkan');
                $this->closeModal(); 
                $this->resetFields();
                return;
            }

            Book::updateOrCreate(['id' => $this->book_id], [
                'title' => $this->title,
                'isbn' => $this->isbn,
                'author' => $this->author,
                'publisher' => $this->publisher,
                'responsible_person' => $this->responsible_person,
                'publication_year' => $this->publication_year,
                'publication_place' => $this->publication_place,
                'description' => $this->description,
                'edition' => $this->edition,
                'gmd' => $this->gmd,
                'call_number' => $this->call_number,
                'language' => $this->language,
                'subject' => $this->subject,
                'amount' => $this->amount,
                'cover_file_name' => $coverFileName,
                'pdf_file_name' => $pdfFileName,
            ]);
        }

        session()->flash('message', $this->book_id ? $this->title . ' Diperbaharui': $this->title . ' Ditambahkan');
            $this->closeModal(); 
            $this->resetFields();
    }

    public function edit($id)
    {
        $book = Book::find($id); 
        $this->book_id = $id;
        $this->title = $book->title;
        $this->isbn = $book->isbn;
        $this->author = $book->author;
        $this->publisher = $book->publisher;
        $this->responsible_person = $book->responsible_person;
        $this->publication_year = $book->publication_year;
        $this->publication_place = $book->publication_place;
        $this->description = $book->description;
        $this->edition = $book->edition;
        $this->gmd = $book->gmd;
        $this->call_number = $book->call_number;
        $this->language = $book->language;
        $this->subject = $book->subject;
        $this->amount = $book->amount;
        $this->cover_file_name = $book->cover_file_name;
        $this->pdf_file_name = $book->pdf_file_name;
        $this->cover_file_name = $book->cover_file_name;
        $this->old_cover_file_name = $book->cover_file_name;
        $this->old_pdf_file_name = $book->pdf_file_name;
        $this->isUpdate = true;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete(); 
        $this->resetFields();
        session()->flash('message', $book->title . ' Dihapus');
    }

    public function multipleDelete($id)
    {
        $book = Book::destroy($id);
        $this->resetFields();
        session()->flash('message','Berhasil dihapus');
    }

    public function checkIsbn($isbn)
    {
        $result = Book::where('isbn',$isbn)->first();
        if($result == null){
            return true;
        }else{
            return false;
        }
    }

}