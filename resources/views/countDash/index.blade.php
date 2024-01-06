@extends('layouts.main')

@section('container')
    <div class="flex justify-center">
        <h1 class="text-2xl font-bold">Selamat Datang {{ Auth::user()->name }} !</h1>
    </div>

    <div class="mt-4 container mx-auto">

        <div class="flex flex-wrap justify-start">
            <!-- Card 1: Jumlah Peserta Didik -->
            <div class="w-1/2 xl:w-2/3 p-4"> <!-- Lebar card pertama diperbesar menjadi 2/3 lebar container -->
                <div class="bg-white rounded-lg p-4 flex items-center shadow-md">
                    <div class="mr-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                      </svg>
                    </div>
                    <div>
                        <p class="text-lg font-bold">Surat Keluar</p>
                        <p class="text-gray-600">{{ $totalLetter }}</p>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
                <div class="bg-white rounded-lg p-4 flex items-center shadow-md">
                    <div class="mr-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-10 h-10">
                        <path stroke-linecap="round" strokeKOMANG ASU EKOMA G P-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                      </svg>
                    </div>
                    <div>
                        <p class="text-lg font-bold">Klasifikasi Surat</p>
                        <p class="text-gray-600">{{ $totalLetter_type }}</p>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
                <div class="bg-white rounded-lg p-4 flex items-center shadow-md">
                    <div class="mr-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                      </svg>
                    </div>
                    <div>
                        <p class="text-lg font-bold">Staff Tata Usaha</p>
                        <p class="text-gray-600">{{ $totalStaff }}</p>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
                <div class="bg-white rounded-lg p-4 flex items-center shadow-md">
                    <div class="mr-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      </svg>
                    </div>
                    <div>
                        <p class="text-lg font-bold">Guru</p>
                        <p class="text-gray-600">{{ $totalGuru }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
