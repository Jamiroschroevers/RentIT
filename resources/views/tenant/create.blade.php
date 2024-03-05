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
    <div class="container mx-auto py-12">
        <article class="bg-white shadow-md rounded-lg w-4/6 p-8 mx-auto flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-8">
            <div>
                <header>
                    <h2 class="text-2xl font-semibold mb-4">Huurder toevoegen</h2>
                </header>
                <form id="tenant-form" method="post" class="flex flex-col space-y-4" enctype="multipart/form-data">
                    @csrf
                    <label for="firstname" class="text-black">Voornaam:</label>
                    <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" autofocus class="border-gray-300 rounded-md shadow-sm input">
                    @error('firstname')
                    <div class="text-red-700 mt-2">{{ $message }}</div>
                    @enderror

                    <label for="lastname" class="text-black">Achternaam:</label>
                    <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" autofocus class="border-gray-300 rounded-md shadow-sm input input-enabled">
                    @error('lastname')
                    <div class="text-red-700 mt-2">{{ $message }}</div>
                    @enderror

                    <label for="birthday" class="text-black">Geboortedatum:</label>
                    <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}" autofocus class="border-gray-300 rounded-md shadow-sm input input-enabled">
                    @error('birthday')
                    <div class="text-red-700 mt-2">{{ $message }}</div>
                    @enderror

                    <label for="email" class="text-black">Email:</label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}" autofocus class="border-gray-300 rounded-md shadow-sm input">
                    @error('email')
                    <div class="text-red-700 mt-2">{{ $message }}</div>
                    @enderror

                    <label for="phonenumber" class="text-black">Telefoonnummer:</label>
                    <input type="text" name="phonenumber" id="phonenumber" value="{{ old('phonenumber') }}" autofocus class="border-gray-300 rounded-md shadow-sm input">
                    @error('phonenumber')
                    <div class="text-red-700 mt-2">{{ $message }}</div>
                    @enderror

                    <button class="button mt-4">
                        Toevoegen
                    </button>
                </form>
            </div>
            <div>
                <label for="signature" class="text-black">Handtekening:</label>
                <canvas id="canvas" style="border: 1px solid #000;" width="400" height="425"></canvas>
            </div>
        </article>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var canvas                    = new fabric.Canvas('canvas')
        canvas.backgroundColor        = '#f0f0f0'
        canvas.freeDrawingBrush.color = '#000000'
        canvas.freeDrawingBrush.width = 5
        canvas.isDrawingMode          = true

        var formSubmitted = false;

        document.getElementById('tenant-form').addEventListener('submit', function(event) {
            if (formSubmitted) {
                event.preventDefault();
                return;
            }

            var imageData = canvas.toDataURL();
            var formData = new FormData(this);


            formData.append('image', imageData);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    formSubmitted = true;
                    document.getElementById('tenant-form').disabled = true;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>



