<x-app-layout>
    <style>
        .input-enabled {
            background-color : #fff;
        }

        .input-disabled {
            background-color : #ffeeba;
        }

        .input {
            border           : 2px solid transparent;
            outline          : none;
            overflow         : hidden;
            background-color : #F3F3F3;
            transition       : all 0.5s;
        }

        .input:hover,
        .input:focus {
            border           : 2px solid #FF1E1F;
            box-shadow       : 0px 0px 0px 7px rgb(255, 30, 31, 20%);
            background-color : white;
        }

        .button {
            --color          : #FF1E1F;
            padding          : 0.4em 0.7em;
            background-color : transparent;
            border-radius    : .3em;
            position         : relative;
            overflow         : hidden;
            cursor           : pointer;
            transition       : .5s;
            font-weight      : 400;
            font-size        : 17px;
            border           : 1px solid;
            font-family      : inherit;
            text-transform   : uppercase;
            color            : var(--color);
            z-index          : 1;
        }

        .button::before, .button::after {
            content          : '';
            display          : block;
            width            : 50px;
            height           : 50px;
            transform        : translate(-50%, -50%);
            position         : absolute;
            border-radius    : 50%;
            z-index          : -1;
            background-color : var(--color);
            transition       : 1s ease;
        }

        .button::before {
            top  : -1em;
            left : -1em;
        }

        .button::after {
            left : calc(100% + 1em);
            top  : calc(100% + 1em);
        }

        .button:hover::before, .button:hover::after {
            height : 410px;
            width  : 410px;
        }

        .button:hover {
            color : rgb(255, 255, 255);
        }

        .button:active {
            filter : brightness(.8);
        }

    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div id="form1" class="form-container">
                    <h2 class="text-3xl font-bold text-black">Storing aanmaken</h2>
                    <form action="{{ route('Hstoring.store') }}" method="post" class="mt-4 flex flex-col"
                          enctype="multipart/form-data">
                        @csrf
                        <label for="description">Beschrijving:</label>
                        <textarea class="text-black border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm input"
                                  name="description" id="description" required></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />

                        <label class="mt-4" for="email">E-mail:</label>
                        <x-text-input class="text-black input" name="email" id="email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        <div class="mt-4">
                            <label for="space" class="text-black">Type ruimte:</label><br>
                            <select class="border-gray-300 rounded-md shadow-sm input" name="space">
                                <option value="">-- option select --</option>
                                <option value="Gemeenschappelijke ruimte">Gemeenschappelijke ruimte</option>
                                <option value="Eigen ruimte">Eigen ruimte</option>
                            </select>
                            <x-input-error :messages="$errors->get('space')" class="mt-2" />
                        </div>

                        <div class="flex items-center mt-4">
                            <input type="checkbox" name="emergency"
                                   class="border-gray-300 rounded-md shadow-sm input text-indigo-600 h-5 w-5">
                            <label for="checkbox" class="ml-2 text-black ">Noodgeval?</label>
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
