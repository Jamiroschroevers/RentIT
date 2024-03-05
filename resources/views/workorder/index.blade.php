<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Monteur
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Storingafhandeling
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Huurder
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Afhandelen
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4">
                                @if($workorder !== null )
                                    {{ $workorder->users->name }}
                                @else
                                    Geen werkbonnen
                                @endif
                            </th>
                            <td class="px-6 py-4">
                                @if($workorder !== null )
                                    {{ $workorder->MalfunctionsHandling->description }}
                                @else
                                    Geen werkbonnen
                                @endif
                            </td>
                            <td class="px-6 py-4">

                                @if($workorder !== null )
                                    {{ $workorder->Tenants->firstname }}
                                    {{ $workorder->Tenants->lastname }}
                                @else
                                    Geen werkbonnen
                                @endif
                            </td>
                            <td class="px-6 py-4 text-white">
                                @if($workorder !== null )
                                    <div class="flex items-center">
                                        <x-primary-button id="openModal" class="mr-5">Werkbon afhandelen</x-primary-button>
                                    </div>
                                @else
                                    Geen werkbonnen
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="myModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        @if($workorder !== null )
            <div class="bg-white shadow-md rounded-lg p-8 w-96 mx-auto">
                <header>
                    <h2 class="text-2xl font-semibold mb-4">Werkbon afhandelen</h2>
                </header>
                <style>
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
                <form id="workorder-form" action="{{ route('workorder.store', $workorder) }}" method="post" class="flex flex-col space-y-4" enctype="multipart/form-data">
                    @csrf
                    <label for="timeregistration" class="text-black">Aantal uren gewerkt:</label>
                    <input type="number" name="timeregistration" id="timeregistration" value="{{ old('timeregistration') }}" autofocus class="border-gray-300 rounded-md shadow-sm input">
                    @error('timeregistration')
                    <div class="text-red-700 mt-2">{{ $message }}</div>
                    @enderror

                    <label for="timeregistration" class="text-black">Prijs:</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" autofocus class="border-gray-300 rounded-md shadow-sm input">
                    @error('price')
                    <div class="text-red-700 mt-2">{{ $message }}</div>
                    @enderror

                    <label for="comments" class="text-black">Opmerking:</label>
                    <input type="text" name="comments" id="comments" value="{{ old('comments') }}" class="border-gray-300 rounded-md shadow-sm input">
                    @error('comments')
                    <div class="text-red-700 mt-2">{{ $message }}</div>
                    @enderror

                    <div>
                        <label for="signature" class="text-black">Handtekening:</label>
                        <canvas id="canvas" style="border: 1px solid #000;" width="320" height="150"></canvas>
                    </div>

                    <button class="button">
                        Aanmaken
                    </button>
                </form>
            </div>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
    <script>
        document.getElementById('openModal').addEventListener('click', function () {
            document.getElementById('myModal').classList.remove('hidden')
        })

        // Close modal when clicking outside of it
        document.getElementById('myModal').addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.add('hidden')
            }
        })
        document.addEventListener('DOMContentLoaded', function () {
            var canvas                    = new fabric.Canvas('canvas')
            canvas.backgroundColor        = '#f0f0f0'
            canvas.freeDrawingBrush.color = '#000000'
            canvas.freeDrawingBrush.width = 5
            canvas.isDrawingMode          = true

            var formSubmitted = false

            document.getElementById('workorder-form').addEventListener('submit', function (event) {
                if (formSubmitted) {
                    event.preventDefault()
                    return
                }

                var imageData = canvas.toDataURL()
                var formData  = new FormData(this)


                formData.append('image', imageData)

                fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data)
                        formSubmitted                                      = true
                        document.getElementById('workorder-form').disabled = true
                    })
                    .catch(error => {
                        console.error('Error:', error)
                    })
            })
        })
    </script>
</x-app-layout>
