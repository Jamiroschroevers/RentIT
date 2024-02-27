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
    <x-slot name="header">
        <div class="flex justify-between">
            <form class="mb-4" action="{{ route('property.index') }}" method="GET">
                <div class="flex" style="border-color: black; border-bottom-style: solid !important; border-bottom-width: 1px !important; width: 448px">
                    <img class="mt-2" style="height: 24px; width: 24px" src="{{ asset('img/icons8-sorting.png') }}">

                    <select id="catergorydropdown"
                            name="status_filter"
                            class="bg-white-100 border-none w-40 inline-flex items-center pr-4 pt-2.5 pb-2.5 text-sm font-medium text-center"
                            style="!important; padding-left: 2px !important;">
                        <option value="">Alle statussen</option>
                        @foreach ($statuses as $status)
                            <option name="status" value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>

                    <div class="relative">
                        <input type="search" id="search-catergorydropdown" name="query" class="bg-white-100 border-none w-72 block p-2.5 pr-8 text-sm" placeholder="Zoekterm...">
                        <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-black">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>

            <div class="flex justify-end items-center">
                <h2 class="text-lg font-semibold mr-4">Huurwoning toevoegen</h2>
                <a href="{{ route('property.create') }}">
                    <x-primary-button class="">Toevoegen</x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>
    <div class="flex flex-wrap">
        @foreach ($properties as $property)
            <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                <div class="bg-white border border-gray-300 shadow-md rounded-md">
                    <div class="p-4">
                        <div class="flex justify-between">
                            <h2 class="text-lg font-semibold mb-2">{{ $property->city }}</h2>
                            <img src="{{ asset('img/icons8-house.png') }}" width="36px" height="36px">
                        </div>
                        <p class="text-gray-600 mb-2">{{ $property->street }}, {{ $property->postal_code }}</p>
                        <p class="text-gray-600 mb-2">Huisnummer: {{ $property->house_number }}</p>
                        <p class="text-gray-600 mb-2">Status: {{ $property->status_id }}</p>
                        <p class="text-gray-600 mb-2">Huurder: {{ $property->tenant_id !== null ? $property->tenant_id : 'Nog geen huurder toegevoegd' }}</p>
                        <a class="flex justify-end" href="{{ route('property.show', $property) }}">
                            <x-primary-button class="text-white" type="submit">
                                Show
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
