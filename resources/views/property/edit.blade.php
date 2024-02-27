<x-app-layout>
    <div class="container mx-auto py-12">
        <article class="bg-white shadow-md rounded-lg p-8 w-96 mx-auto">
            <header>
                <h2 class="text-2xl font-semibold mb-4">Huurwoning bijwerken</h2>
            </header>
            <style>
                .input-enabled {
                    background-color: #fff;
                }
                .input-disabled {
                    background-color: #ffeeba;
                }
            </style>

            <form action="{{ route('property.update', $property) }}" method="post" class="flex flex-col space-y-4" enctype="multipart/form-data">
                @csrf
                @method('put')
                <label for="name" class="text-black">Postcode:</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $property->postal_code) }}" autofocus class="border-gray-300 rounded-md shadow-sm input">
                @error('postal_code')
                <div class="text-red-700 mt-2">{{ $message }}</div>
                @enderror

                <label for="name" class="text-black">Straat:</label>
                <input type="text" name="street" id="street" value="{{ old('street', $property->street) }}" autofocus class="border-gray-300 rounded-md shadow-sm input input-enabled">
                @error('street')
                <div class="text-red-700 mt-2">{{ $message }}</div>
                @enderror

                <label for="name" class="text-black">Stad:</label>
                <input type="text" name="city" id="city" value="{{ old('city', $property->city) }}" autofocus class="border-gray-300 rounded-md shadow-sm input input-enabled">
                @error('city')
                <div class="text-red-700 mt-2">{{ $message }}</div>
                @enderror

                <label for="name" class="text-black">Huisnummer:</label>
                <input type="text" name="house_number" id="house_number" value="{{ old('house_number', $property->house_number) }}" autofocus class="border-gray-300 rounded-md shadow-sm input">
                @error('house_number')
                <div class="text-red-700 mt-2">{{ $message }}</div>
                @enderror

                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Bijwerken
                </button>
            </form>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#postal_code').on('input', function () {
                        var postcode = $(this).val().replace(/\s/g, '');
                        if (postcode.length >= 6) {
                            $.ajax({
                                url: '/get-address/' + postcode,
                                type: 'GET',
                                data: {postcode: postcode},
                                success: function (data) {
                                    const city = document.getElementById('city');
                                    city.value = data.city;
                                    city.classList.remove('input-enabled');
                                    city.classList.add('input-disabled');

                                    const street = document.getElementById('street');
                                    street.value = data.street;
                                    street.classList.remove('input-enabled');
                                    street.classList.add('input-disabled');
                                }
                            });
                        } else {
                            const city = document.getElementById('city');
                            city.value = '';
                            city.classList.remove('input-disabled');
                            city.classList.add('input-enabled');

                            const street = document.getElementById('street');
                            street.value = '';
                            street.classList.remove('input-disabled');
                            street.classList.add('input-enabled');
                        }
                    });
                });
            </script>
        </article>
    </div>
</x-app-layout>
