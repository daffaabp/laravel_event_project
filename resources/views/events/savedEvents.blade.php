@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Saved Events') }}
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
                    <tbody id="table-body">
                        {{-- perbedaan utama antara foreach dan forelse adalah bagaimana mereka menangani kasus ketika tidak ada data yang ditemukan. foreach tidak melakukan apa-apa, sementara forelse memberikan Anda kesempatan untuk menampilkan pesan khusus atau tindakan alternatif ketika data kosong --}}
                        @forelse($events as $event)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $event->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ Carbon::parse($event->start_datetime)->format('d F Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->country->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <button data-modal-target="showModal" data-modal-toggle="showModal"
                                        data-idevent="{{ $event->id }}"
                                        class="btn-detail-event block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button">
                                        Detail
                                    </button>
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


        <!-- Main modal -->
        <div id="showModal" data-modal-backdrop="showModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Detail Information
                        </h3>

                        <button type="button" id="event-detail-btn-close"
                            class="inline-flex items-center justify-center w-8 h-8 ml-auto text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="showModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-6 space-y-6" id="modalContent">

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <tbody>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            Title
                                        </th>
                                        <td class="px-6 py-4">:</td>
                                        <td class="px-6 py-4" id="event-detail-title"></td>
                                    </tr>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            Description
                                        </th>
                                        <td class="px-6 py-4">:</td>
                                        <td class="px-6 py-4" id="event-detail-desc"></td>
                                    </tr>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            Address
                                        </th>
                                        <td class="px-6 py-4">:</td>
                                        <td class="px-6 py-4" id="event-detail-address"></td>
                                    </tr>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            Num Tickets
                                        </th>
                                        <td class="px-6 py-4">:</td>
                                        <td class="px-6 py-4" id="event-detail-tickets"></td>
                                    </tr>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            Image
                                        </th>
                                        <td class="px-6 py-4">:</td>
                                        <td class="px-6 py-4">
                                            <img id="event-detail-image" src="" alt=""
                                                class="img-fluid img-thumbnail" width="200px">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Temukan semua tombol "Detail" dengan atribut data-modal-toggle
            const showModalButtons = document.querySelectorAll('[data-modal-toggle="showModal"]');

            // Loop melalui semua tombol dan tambahkan event listener
            showModalButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const modalId = button.getAttribute('data-modal-target');
                    const modal = document.getElementById(modalId);

                    // Tampilkan modal
                    if (modal) {
                        modal.classList.remove('hidden');
                    }
                });
            });

            // Temukan tombol-tombol untuk menyembunyikan modal
            const closeModalButtons = document.querySelectorAll('[data-modal-hide="showModal"]');

            // Loop melalui tombol-tombol tersebut dan tambahkan event listener
            closeModalButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const modalId = button.getAttribute('data-modal-hide');
                    const modal = document.getElementById(modalId);

                    // Sembunyikan modal
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                });
            });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // $('#showModal').on('click', function(param) {
            //     console.log($.this);
            // })

            // let modal = document.getElementById('showModal');

            // modal.addEventListener('change', function(e) {
            //     console.log('changed!!!');
            // });

            document.querySelector('#event-detail-btn-close').addEventListener("click", function(e) {
                document.querySelector('#event-detail-title').textContent = '';
                document.querySelector('#event-detail-desc').textContent = '';
                document.querySelector('#event-detail-address').textContent = '';
                document.querySelector('#event-detail-tickets').textContent = '';
                document.querySelector('#event-detail-image').file = '';
            });

            document.querySelector('#table-body').addEventListener("click", function(e) {
                const {
                    target
                } = e;

                if (target.tagName === 'BUTTON') {
                    // sudah bisa dapet id // sudah aman
                    let idevent = document.querySelector('#idevent');
                    // console.log(idevent);
                    // idevent.textContent = target.getAttribute('data-idevent');

                    // ambil data menggunakan ajax berdasarkan id event
                    $.ajax({
                        type: 'GET',
                        url: '/saved-events/get-detail/' + target.getAttribute('data-idevent'),
                        success: function(data) {
                            // console.log(data);
                            // todo set value into modal
                            // Show Title Event
                            document.querySelector('#event-detail-title').textContent = data
                                .title;

                            // Show Description
                            document.querySelector('#event-detail-desc').textContent = data
                                .description;

                            // Show Address
                            document.querySelector('#event-detail-address').textContent =
                                data
                                .address;

                            // Show Num Tickets
                            document.querySelector('#event-detail-tickets').textContent = data
                                .num_tickets;

                            // Show Image
                            var image = data.image;
                            console.log(image);


                            $("#event-detail-image").attr('src', '/storage/' + image);


                            // Handle Error
                        },
                        error: function(request, status, error) {
                            // alert(request.responseText);
                            console.log('error: ' + error);
                        }
                    });
                }
            });

            // Temukan semua tombol "Detail" dengan atribut data-modal-toggle
            // const showModalButtons = document.querySelectorAll('[data-modal-toggle="showModal"]');

            // Loop melalui semua tombol dan tambahkan event listener
            // showModalButtons.forEach(function(button) {
            //     button.addEventListener('click', function() {
            //         const modalId = button.getAttribute('data-modal-target');
            //         const modal = document.getElementById(modalId);

            //         // Tampilkan modal
            //         if (modal) {
            //             modal.classList.remove('hidden');
            //         }
            //     });
            // });
        });
    </script>

</x-app-layout>
