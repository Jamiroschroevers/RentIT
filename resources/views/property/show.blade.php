<x-app-layout>
    @if (session()->has('message'))
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:text-green-400"
             role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
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
                @if(Auth::user()->role_id !== $admin)
                    <form action="{{ route('property.update', $property) }}" method="post" class=""
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <label for="postal_code" class="text-black font-bold">Postcode:</label>
                        <input type="text" name="postal_code" id="postal_code"
                               value="{{ old('postal_code', $property->postal_code) }}"
                               class="border-white rounded-md input">
                        @error('postal_code')
                        <div class="text-red-700 mt-2">{{ $message }}</div>
                        @enderror
                        <br>

                        <label for="street" class="text-black font-bold">Straat:</label>
                        <input type="text" name="street" id="street" value="{{ old('street', $property->street) }}"
                               class="border-white rounded-md input">
                        @error('street')
                        <div class="text-red-700 mt-2">{{ $message }}</div>
                        @enderror
                        <br>

                        <label for="city" class="text-black font-bold">Stad:</label>
                        <input type="text" name="city" id="city" value="{{ old('city', $property->city) }}"
                               class="border-white rounded-md input">
                        @error('city')
                        <div class="text-red-700 mt-2">{{ $message }}</div>
                        @enderror
                        <br>

                        <label for="house_number" class="text-black font-bold">Huisnummer:</label>
                        <input type="text" name="house_number" id="house_number"
                               value="{{ old('house_number', $property->house_number) }}"
                               class="border-white rounded-md input">
                        <br>

                        <label for="status_filter" class="text-black font-bold">Status:</label>
                        <select id="status_filter" name="status_filter"
                                class="bg-white-100 border-none w-32 inline-flex items-center pr-4 pt-2.5 pb-2.5 text-sm font-medium text- rounded-md"
                                style="padding-left: 2px !important;">
                            @foreach ($statuses as $status)
                                <option name="status"
                                        value="{{ $status->id }}" {{ $status->id == $property->status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                            @endforeach
                        </select>
                        @error('status_filter')
                        <div class="text-red-700 mt-2">{{ $message }}</div>
                        @enderror


                        <div class="flex items-center mb-4">
                            <strong class="mr-2">Huurder:</strong>
                            <p class="m-0">{{ $property->tenant_id }}</p>
                        </div>
                        <div id="error-message" class="text-red-700 mt-2"></div>

                        <div class="flex justify-end">
                            <form action="{{ route('property.destroy', $property) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                            </form>
                        </div>
                        @else
                            <p class="mb-2"><strong>Straat:</strong> {{ $property->street }}</p>
                            <p class="mb-2"><strong>Huisnummer:</strong> {{ $property->house_number }}</p>
                            <p class="mb-2"><strong>Postcode:</strong> {{ $property->postal_code }}</p>
                            <p class="mb-2"><strong>Stad:</strong> {{ $property->city }}</p>
                            <p class="mb-2"><strong>Status:</strong> {{ $property->status->name }}</p>
                            <p class="mb-4"><strong>Huurder:</strong> {{ $property->tenant_id }}</p>
                     @if(Auth::user()->role_id === $admin)
                    @if($property->tenant_id === null)
                        <a href="{{ route('tenant.create', $property) }}">
                            <x-primary-button class="">Huurder toevoegen</x-primary-button>
                        </a>
                    @endif
                    <div class="flex justify-end">
                        <form action="{{ route('property.destroy', $property) }}" method="POST">
                            <a href="{{ route('property.edit', $property) }}" class="text-blue-500 hover:text-blue-700 text-sm mr-4">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </article>
    <script>
        function save_field(fieldName) {
            const field = document.getElementById(fieldName).value;
            const errorMessageElement = document.getElementById('error-message');
            var propertyId = "{{ $property->id }}";

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/save_property/' + propertyId, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onload = function () {
                errorMessageElement.textContent = xhr.status === 200 ? '' : 'Er is een fout opgetreden bij het opslaan van de stad.';
            };
            xhr.onerror = function () {
                errorMessageElement.textContent = 'Er is een fout opgetreden bij het opslaan van de stad.';
            };
            xhr.send(JSON.stringify({field: field, fieldName: fieldName}));
        }

        document.getElementById('postal_code').addEventListener('blur', function () {
            save_field('postal_code');
        });

        document.getElementById('street').addEventListener('blur', function () {
            save_field('street');
        });

        document.getElementById('city').addEventListener('blur', function () {
            save_field('city');
        });

        document.getElementById('house_number').addEventListener('blur', function () {
            save_field('house_number');
        });

        // Status AJAX
        document.getElementById('status_filter').addEventListener('change', function () {
            save_field('status_filter');
        });
    </script>

</x-app-layout>
