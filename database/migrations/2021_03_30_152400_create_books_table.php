<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->char('title');
            $table->char('isbn');
            $table->char('author');
            $table->char('publisher')->default('-');
            $table->char('responsible_person')->nullable();
            $table->year('publication_year');
            $table->char('publication_place');
            $table->text('description');
            $table->char('edition')->default('-');
            $table->char('gmd')->default('text');
            $table->char('call_number')->default('-');
            $table->char('language')->default('-');
            $table->text('subject')->default('-');
            $table->integer('amount')->default(1);
            $table->text('cover_file_name')->nullable();
            $table->text('pdf_file_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
