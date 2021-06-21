<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="mt-20">
            @csrf

            <div class="w-full md:flex">
                <div class="w-full md:w-6/12 mx-2">
                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                </div>
                
                <hr class="my-10 md:my-0">

                <div class="w-full md:w-6/12 mx-2">
                    <div>
                        <x-jet-label for="identity_type" value="{{ __('No. Identitas') }}" />
                        <div class="flex">
                            <select name="identity_type" id="identity_type" :value="old('identity_type')" class="block mt-1 w-1/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="NIK">KTP / NIK</option>
                                <option value="NISN">NISN (Nomor Induk Siswa Nasional)</option>
                                <option value="KITAS">KITAS (khusus WNA)</option>
                            </select>
                            <x-jet-input id="identity_number" class="block mt-1 w-full" type="text" name="identity_number" :value="old('identity_number')" required autocomplete="identity_number" placeholder="Masukan nomor identitas"/>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="birth_place" value="{{ __('Tempat / tanggal lahir') }}" />
                        <div class="flex">
                            <input type="text" name="birth_place" id="birth_place" :value="old('birth_place')" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="Tempat lahir">
                            <x-jet-input id="date_of_birth" class="block mt-1 w-2/4" type="date" name="date_of_birth" :value="old('date_of_birth')" required/>
                        </div>                    
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="address" value="{{ __('Alamat') }}" /><sup class="text-gray-700">jalan, rt/rw, kecamatan, kota</sup>
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" required autocomplete="address" :value="old('address')"/>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="phone_number" value="{{ __('Nomor Telpon') }}" /><sup class="text-gray-700">contoh : 628xxxxxxx</sup> 
                        <x-jet-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" required autocomplete="phone_number" :value="old('phone_number')"/>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="gender" value="{{ __('gender') }}" />
                        <input type="radio" name="gender" id="gender" value="1"> Pria
                        <br>
                        <input type="radio" name="gender" id="gender" value="0"> Wanita
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="profession" value="{{ __('Pekerjaan') }}" />
                        <select name="profession" id="profession" :value="old('profession')" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" :value="old('profession')">
                            <option>pilih</option>
                            <option value="bumn">BUMN</option>
                            <option value="pegawai negeri">Pegawai Negeri</option>
                            <option value="peneliti">Peneliti</option>
                            <option value="tni/polri">TNI/POLRI</option>
                            <option value="pegawai swasta">Pegawai Swasta</option>
                            <option value="dosen">Dosen</option>
                            <option value="pensiunan">Pensiunan</option>
                            <option value="wiraswasta">Wiraswasta</option>
                            <option value="guru">Guru</option>
                            <option value="pelajar">Pelajar</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <hr class="my-5">

                    <div class="mt-4">
                        <x-jet-label for="institution" value="{{ __('Nama Institusi') }}" /><sup class="text-gray-700">contoh : Sekolah, Universitas, Instansi, Kantor</sup>
                        <x-jet-input id="institution" class="block mt-1 w-full" type="text" name="institution" required autocomplete="institution" :value="old('institution')"/>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="institution_address" value="{{ __('Alamat Institusi') }}" />
                        <x-jet-input id="institution_address" class="block mt-1 w-full" type="text" name="institution_address" required autocomplete="institution_address" :value="old('institution_address')"/>
                    </div>

                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center justify-end">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-10">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>
