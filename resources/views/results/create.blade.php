@extends('layouts.main')

@section('container')

<form method="post" action="{{ route('results.store.guru') }}">
    @csrf
    
    <div class="mb-4">
        <input type="hidden" id="letter_id" name="letter_id" value="{{ $letter->id }}" class="mr-2">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Guru:</label>
        @foreach($users as $guru)
            <div class="flex items-center">
                <input type="checkbox" id="presence_recipients{{ $guru->id }}" name="presence_recipients[]" value="{{ $guru->id }}" class="mr-2 @error('presence_recipients[]') is-invalid @enderror">
                <label for="presence_recipients{{ $guru->id }}">{{ $guru->name }}</label>
            </div>
        @endforeach
        @error('presence_recipients')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>

    <div class="mb-6">
        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">notes</label>
        <input type="hidden" id="notes" name="notes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('notes') is-invalid @enderror" value="{{ old('notes') }}" required autofocus>
        <trix-editor input="notes"></trix-editor>
  
        @error('notes')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

    <button type="submit" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Create</button>
@endsection