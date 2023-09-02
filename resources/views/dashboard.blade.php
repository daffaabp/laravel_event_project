<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="mb-4 text-lg font-semibold">
                        {{ __('Welcome to your dashboard!') }}
                    </h3>

                    @if ($ongoingEvents->count() > 0)
                        <div class="mt-6">
                            <h3 class="mb-2 text-lg font-semibold">Event Hari ini</h3>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                @foreach ($ongoingEvents as $event)
                                    <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                        <div class="flex items-center mb-3">
                                            <div class="w-12 h-12">
                                                <img class="w-12 h-12 rounded-full"
                                                    src="{{ asset('/storage/' . $event->image) }}"
                                                    alt="{{ $event->title }}">
                                            </div>
                                            <div class="ml-2">
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $event->title }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $event->city->name }}</p>
                                            </div>
                                        </div>
                                        <p class="mb-2 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $event->start_datetime->format('d-m-Y, H:i') }} -
                                            {{ $event->end_date->format('d/m/Y') }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $event->address }}</p>
                                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                            {{ Str::limit($event->description, 100, ' ...') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </>
            </div>
        </div>
    </div>
</x-app-layout>
