<x-main-layout>
    <!-- component -->
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">All Galleries</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($galleries as $gallery)
                    <div class="lg:flex">
                        <img class="object-cover w-32 p-3 border-4 rounded-lg h-44 lg:w-52"
                            src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->caption }}"> <br> <br>
                        <p class="pl-3 mt-16 text-xl font-semibold text-gray-800 capitalize dark:text-white">
                            {{ $gallery->caption }}</p>
                    </div>
                @endforeach
            </div>
            {{ $galleries->links() }}
        </div>
    </section>
</x-main-layout>
