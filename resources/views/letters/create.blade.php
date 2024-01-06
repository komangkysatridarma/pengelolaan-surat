@extends('layouts.main')

@section('container')

<form method="post" action="{{ route('letters.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-6">
      <label for="letter_perihal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Perihal</label>
      <input type="text" id="letter_perihal" name="letter_perihal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('letter_perihal') is-invalid @enderror" value="{{ old('letter_perihal') }}" required autofocus>

      @error('letter_perihal')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-4">
      <label for="letter_type_id" class="block text-gray-700 text-sm font-bold mb-2">Klarifikasi Surat:</label>
      <select name="letter_type_id" id="letter_type_id" class="w-full border rounded-md p-2">
          <option selected disabled>Surat</option>
          @foreach($letter_types as $lt)
              <option value="{{ $lt->id }}">{{ $lt->name_type }}</option>
          @endforeach
      </select>
  </div>

    <div class="mb-6">
      <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
      <input type="hidden" id="content" name="content" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('perihal') is-invalid @enderror" value="{{ old('perihal') }}" required autofocus>
      <trix-editor input="content"></trix-editor>

      @error('content')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Guru:</label>
      @foreach($users as $guru)
          <div class="flex items-center">
              <input type="checkbox" id="recipients{{ $guru->id }}" name="recipients[]" value="{{ $guru->id }}" class="mr-2">
              <label for="recipients{{ $guru->id }}">{{ $guru->name }}</label>
          </div>
      @endforeach
  </div>

  <div class="mb-6">
    <label for="attachment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lampiran</label>
    <input type="file" id="attachment" name="attachment" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('attachment') is-invalid @enderror">
    
    @error('attachment')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


<div class="mb-4">
  <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Notulis:</label>
  <select name="user_id" id="user_id" class="w-full border rounded-md p-2">
      <option selected disabled>Notulis</option>
      @foreach($users as $notulis)
          <option value="{{ $notulis->id }}">{{ $notulis->name }}</option>
      @endforeach
  </select>
</div>

  
  
    <button type="submit" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Create</button>
@endsection