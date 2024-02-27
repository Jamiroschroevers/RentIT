<x-app-layout>
    @if (session()->has('message'))
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:text-green-400"
             role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">{{ session()->get('message') }}</span>
            </div>
        </div>
    @endif
    <article class="bg-gray-100 p-8 md:p-12">
        <div class="w-full md:w-2/3 bg-white mx-auto shadow-md rounded-md">
            <h1 class="text-3xl md:text-4xl font-bold mb-6 px-6 py-4 bg-gray-200 rounded-t-md">
                <div class="flex justify-between">
                    Huurwoning details
                    <img src="{{ asset('img/icons8-house.png') }}" width="40px" height="40px">
                </div>
            </h1>
            <div class="p-6">
                <p class="mb-2"><strong>Straat:</strong> {{ $property->street }}</p>
                <p class="mb-2"><strong>Huisnummer:</strong> {{ $property->house_number }}</p>
                <p class="mb-2"><strong>Postcode:</strong> {{ $property->postal_code }}</p>
                <p class="mb-2"><strong>Stad:</strong> {{ $property->city }}</p>
                <p class="mb-2"><strong>Status:</strong> {{ $property->status_id }}</p>
                <p class="mb-4"><strong>Huurder:</strong> {{ $property->tenant_id }}</p>
                <div class="flex justify-end">
                    <form action="{{ route('property.destroy', $property) }}" method="POST">
                        <a href="{{ route('property.edit', $property) }}" class="text-blue-500 hover:text-blue-700 text-sm mr-4">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </article>
</x-app-layout>
