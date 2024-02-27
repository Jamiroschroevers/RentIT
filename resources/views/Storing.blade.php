<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div id="form1" class="form-container">
                    <h2 class="text-3xl font-bold text-black">Storing aanmaken</h2>
                    <form action="{{ route('Hstoring.store') }}" method="post" class="mt-4 flex flex-col"
                        enctype="multipart/form-data">
                        @csrf
                        <label for="description">Beschrijving:</label>
                        <textarea class="text-black border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            name="description" id="description" required></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />

                        <label class="mt-4" for="email">E-mail:</label>
                        <x-text-input class="text-black" name="email" id="email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        <div class="mt-4">
                            <label for="space" class="text-black">Type ruimte:</label>
                            <select class="border-gray-300 rounded-md shadow-sm" name="space">
                                <option value="">-- option select --</option>
                                <option value="Gemeenschappelijke ruimte">Gemeenschappelijke ruimte</option>
                                <option value="Eigen ruimte">Eigen ruimte</option>
                            </select>
                            <x-input-error :messages="$errors->get('space')" class="mt-2" />
                        </div>

                        <div class="flex items-center mt-4">
                            <input type="checkbox" name="emergency"
                                class="border-gray-300 rounded-md shadow-sm input text-indigo-600 h-5 w-5">
                            <label for="checkbox" class="ml-2 text-black">Noodgeval?</label>
                        </div>

                        <x-primary-button class="mt-4 w-1/5 flex items-center justify-center" type="submit">Storing
                            sturen</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
