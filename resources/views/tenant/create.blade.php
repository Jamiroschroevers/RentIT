<x-app-layout>
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

                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Aanmaken
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



