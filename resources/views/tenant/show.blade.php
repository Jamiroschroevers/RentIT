<x-app-layout>
    <div class="container mx-auto py-12">
        <a href="{{ route('property.show', $property) }}">
        <img class="mt-2 h-full " style="height: 24px; width: 24px; rotate: 180deg;" src="{{ asset('img/icons8-arrow.png') }}">
        </a>
        <article class="bg-white shadow-md rounded-lg w-4/6 p-8 mx-auto flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-8">
            <div>
                <header>
                    <h2 class="text-2xl font-semibold mb-4">Huurder informatie</h2>
                </header>
                <div>
                    <p><strong>Voornaam:</strong> {{ $tenant->firstname }}</p>
                    <p><strong>Achternaam:</strong> {{ $tenant->lastname }}</p>
                    <p><strong>Geboortedatum:</strong> {{ $tenant->birthday }}</p>
                    <p><strong>Email:</strong> {{ $tenant->email }}</p>
                    <p><strong>Telefoonnummer:</strong> {{ $tenant->phonenumber }}</p>
                </div>
            </div>
            <div>
                <label for="signature" class="text-black">Handtekening:</label>
                <img src="{{ asset('storage/' . $tenant->signature) }}" style="border: 1px solid #000;" width="400" height="425">
            </div>
        </article>
    </div>
</x-app-layout>
