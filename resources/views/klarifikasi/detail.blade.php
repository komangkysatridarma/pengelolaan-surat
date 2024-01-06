@extends('layouts.main')

@section('container')
    <div class="p-4">
        <h1 class="text-2xl font-semibold">{{ $letter_type->name_type }} ({{ $letter_type->letter_code }})</h1>
        <div class="flex flex-wrap">
        @foreach ($letters as $letter)
            <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
                <div class="bg-white rounded-lg p-4 flex items-center shadow-md">
                    <div class="mr-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                          </svg>
                    </div>
                    <div>
                        <p class="text-lg font-bold">{{ $letter_type->created_at->format('d M Y') }}</p>
                        <p class="text-gray-600">@foreach (json_decode($letter->recipients) as $recipientId)
                            {{ \App\Models\User::find($recipientId)->name }}
                            @if (!$loop->last)
                                , 
                            @endif
                        @endforeach</p>
                    </div>
                    <div class="ml-auto mb-16">
                        <!-- Add the provided icon here -->
                        <a href="{{ route('klaf.download.pdf', ['id' => $letter->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
@endsection
