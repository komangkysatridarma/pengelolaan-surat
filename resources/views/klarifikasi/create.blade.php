@extends('layouts.main')

@section('container')

<form method="post" action="{{ route('klaf.store') }}">
    @csrf
    <div class="mb-6">
      <label for="letter_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Surat</label>
      <input type="number" id="letter_code" name="letter_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('letter_code') is-invalid @enderror" value="{{ old('letter_code') }}" required autofocus>

      @error('letter_code')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-6">
      <label for="name_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klarifikasi Surat</label>
      <input type="text" id="name_type" name="name_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name_type') is-invalid @enderror" value="{{ old('name_type') }}" required autofocus>

      @error('name_type')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Create</button>
@endsection