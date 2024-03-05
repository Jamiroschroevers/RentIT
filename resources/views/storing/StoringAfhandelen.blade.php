<x-app-layout>
    <style>
        .input-enabled {
            background-color: #fff;
        }

        .input-disabled {
            background-color: #ffeeba;
        }

        .input {
            border: 2px solid transparent;
            outline: none;
            overflow: hidden;
            background-color: #F3F3F3;
            transition: all 0.5s;
        }

        .input:hover,
        .input:focus {
            border: 2px solid #FF1E1F;
            box-shadow: 0px 0px 0px 7px rgb(255, 30, 31, 20%);
            background-color: white;
        }

        .button {
            --color: #FF1E1F;
            padding: 0.4em 0.7em;
            background-color: transparent;
            border-radius: .3em;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: .5s;
            font-weight: 400;
            font-size: 17px;
            border: 1px solid;
            font-family: inherit;
            text-transform: uppercase;
            color: var(--color);
            z-index: 1;
        }

        .button::before,
        .button::after {
            content: '';
            display: block;
            width: 50px;
            height: 50px;
            transform: translate(-50%, -50%);
            position: absolute;
            border-radius: 50%;
            z-index: -1;
            background-color: var(--color);
            transition: 1s ease;
        }

        .button::before {
            top: -1em;
            left: -1em;
        }

        .button::after {
            left: calc(100% + 1em);
            top: calc(100% + 1em);
        }

        .button:hover::before,
        .button:hover::after {
            height: 410px;
            width: 410px;
        }

        .button:hover {
            color: rgb(255, 255, 255);
        }

        .button:active {
            filter: brightness(.8);
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div id="form1" class="form-container">
                    <form action="{{ route('Astoring.update', $malfunction->id) }}" method="POST"
                        class="flex items-center justify-between">
                        @csrf
                        @method('PUT')
                        <h2 class="text-3xl font-bold text-black">Storing afhandelen</h2>
                        <button class="button mt-4 w-1/5">
                            Storing Opnieuw plannen
                        </button>
                    </form>
                    <form action="{{ route('StoringH.store') }}" method="post" class="mt-4 flex flex-col"
                        enctype="multipart/form-data">
                        @csrf
                        <label for="description">Beschrijving:</label>
                        <textarea class="text-black border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm input"
                            name="description" id="description" required></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />

                        <label class="mt-4" for="activities">Activiteiten:</label>
                        <textarea class="text-black border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm input"
                            name="activities" id="activities" required></textarea>
                        <x-input-error :messages="$errors->get('activities')" class="mt-2" />

                        <label class="mt-4" for="mileage">Kilometerstand:</label>
                        <x-text-input class="text-black mb-4 input" name="mileage" id="mileage" required />
                        <x-input-error :messages="$errors->get('mileage')" class="mt-2" />

                        <div class="flex justify-between">
                            <div>
                                <label class="mt-4" for="material">Materialen:</label>
                                <x-text-input class="text-black input" name="material" id="material" required />
                                <x-input-error :messages="$errors->get('material')" class="mt-2" />
                            </div>

                            <div>
                                <label class="mt-4" for="Hoeveelheid">Hoeveelheid:</label>
                                <x-text-input class="text-black input" name="Hoeveelheid" id="Hoeveelheid" required />
                                <x-input-error :messages="$errors->get('Hoeveelheid')" class="mt-2" />
                            </div>

                            <div>
                                <label class="mt-4" for="Kosten">Kosten:</label>
                                <x-text-input class="text-black input" name="Kosten" id="Kosten" required />
                                <x-input-error :messages="$errors->get('Kosten')" class="mt-2" />
                            </div>
                        </div>

                        <button class="button mt-4 w-1/5">
                            Storing aanmaken
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
