@extends('layouts.main')

@section('container')

<div class="flex items-center mt-2 space-x-2">
  <div class="flex-grow mx-0">
    <form action="{{ route('letters.home.guru') }}" method="GET">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative flex items-center">
            <div class="relative">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" name="search_letters_guru" id="default-search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search letters...." value="{{request('search_letters_guru')}}" required>
            <button type="submit" class="text-white ml-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:text-sm sm:px-4">Search</button>
        </div>
    </form>
</div> 

  <div class="flex">
      {{ $letters->links() }}
  </div>
</div>

  <div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            No
          </th>
          <th scope="col" class="px-6 py-3">
            Kode Surat
          </th>
          <th scope="col" class="px-6 py-3">
            Perihal
          </th>
          <th scope="col" class="px-6 py-3">
            Tanggal Keluar
          </th>
          <th scope="col" class="px-6 py-3">
            Penerima Surat
          </th>
          <th scope="col" class="px-6 py-3">
            Notulis
          </th>
          <th scope="col" class="px-6 py-3">
            Hasil Rapat
          </th>
          <th scope="col" class="px-6 py-3">
            Detail
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($letters as $letter)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ $loop->iteration }}
            </th>
        <td class="px-6 py-4">
            @if ($letter->letter_type)
                {{ $letter->letter_type->letter_code }}
            @else
                Letter type not found
            @endif
        </td>
            <td class="px-6 py-4">
              {{ $letter->letter_perihal }}
            </td>
            <td class="px-6 py-4">
              {{ $letter->created_at->format('d M Y') }}
            </td>
            <td class="px-6 py-4">
              @foreach (json_decode($letter->recipients) as $recipientId)
                  @php
                      $recipient = \App\Models\User::find($recipientId);
                  @endphp
                  @if ($recipient)
                      {{ $recipient->name }}
                  @else
                      User not found
                  @endif
              @endforeach
          </td>
          <td class="px-6 py-4">
            @if ($letter->user)
                {{ $letter->user->name }}
            @else
                User not found
            @endif
        </td>
        <td class="px-6 py-4">
        @if ($letter->meeting_minutes_status == 'Belum Dibuat')
                <a href="{{ route('results.create.guru', $letter->id) }}" class="text-yellow-500">Buat Hasil Rapat</a>
            @else
                <span class="text-lime-600">Sudah Dibuat</span>
            @endif
        </td>
        <td class="px-6 py-4 flex flex-row">
          <a href="{{ route('results.detail.guru', $letter->id) }}" class="pr-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>                  
          </a>
        </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
