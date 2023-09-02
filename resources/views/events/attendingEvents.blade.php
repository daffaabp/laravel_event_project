@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Attending Events') }}
            </h2>
        </div>
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
                                Time Attending
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
                                <th scope="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('eventShow', $event) }}"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white hover:text-green-600"
                                            target="blank_">{{ $event->title }}</a>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    @if ($event->attendings->count() > 0)
                                        {{ $event->attendings->first()->created_at->format('d F Y, H:i') }}
                                    @else
                                        No likes yet
                                    @endif
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
