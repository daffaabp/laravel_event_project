@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between mb-3">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Events') }}
            </h2>
            <div>
                <a href="{{ route('events.create') }}" class="dark:text-white hover:text-slate-200">New Event</a>
            </div>
        </div>

        <form action="" method="get">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative w-2/3 m-auto">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="default-search" name="keyword"
                    class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search Event Here ...">
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

    </x-slot>

    <div class="py-12">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- Awal Menampilkan semua acara --}}
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Province
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- perbedaan utama antara foreach dan forelse adalah bagaimana mereka menangani kasus ketika tidak ada data yang ditemukan. foreach tidak melakukan apa-apa, sementara forelse memberikan Anda kesempatan untuk menampilkan pesan khusus atau tindakan alternatif ketika data kosong --}}
                        @forelse($events as $event)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {!! str_replace(
                                        $keyword,
                                        '<span style="background-color: yellow; font-weight: bold;">' . $keyword . '</span>',
                                        $event->title,
                                    ) !!}
                                </th>
                                <td class="px-6 py-4">
                                    {{ Carbon::parse($event->start_datetime)->format('d-m-Y, H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->country->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('events.edit', $event) }}"
                                            class="text-green-400 hover:text-green-600">Edit</a>
                                        <form method="POST" class="text-red-400 hover:text-red-600"
                                            action="{{ route('events.destroy', $event) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('events.destroy', $event) }}" class="confirm-button"
                                                title-id="{{ $event->title }}">
                                                Delete
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No events found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Akhir Menampilkan semua acara --}}
    </div>
</x-app-layout>
