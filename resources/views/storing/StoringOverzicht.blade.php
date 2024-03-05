<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Beschrijving
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ruimte
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Huurder
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Huurwoning
                            </th>
                            <th scope="col" class="px-6 py-3">
                                status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Monteur inplannen
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Auth::user()->role_id == 1)
                            @foreach ($malfunctions as $malfunction)
                                @if ($malfunction->emergency == true)
                                    <tr class="bg-red-400">
                                        <th scope="row" class="px-6 py-4 text-white">
                                            {{ $malfunction->description }}
                                        </th>
                                        <td class="px-6 py-4 text-white">
                                            {{ $malfunction->space }}
                                        </td>
                                        <td class="px-6 py-4 text-white">
                                            {{ $malfunction->Tenants->firstname }}
                                        </td>
                                        <td class="px-6 py-4 text-white">
                                            {{ $malfunction->Tenants->Properties[0]->street }}
                                            {{ $malfunction->Tenants->Properties[0]->house_number }}
                                        </td>
                                        <td class="px-6 py-4 text-white">
                                            {{ $malfunction->Status->name }}
                                        </td>
                                        <td class="px-6 py-4 text-white">
                                            @if ($malfunction->status_id == 4)
                                                <form action="{{ route('Astoring.store', $malfunction->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <select
                                                        class="border-gray-300 text-black focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        name="monteur" id="monteur">
                                                        <option value="">-- select a option --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-primary-button type="submit">
                                                        Monteur inplannen
                                                    </x-primary-button>
                                                </form>
                                            @else
                                                Deze storing heeft al een monteur
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    <tr class="bg-white border-b">
                                        <th scope="row" class="px-6 py-4">
                                            {{ $malfunction->description }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $malfunction->space }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $malfunction->Tenants->firstname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $malfunction->Tenants->Properties[0]->street }}
                                            {{ $malfunction->Tenants->Properties[0]->house_number }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $malfunction->Status->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($malfunction->status_id == 4)
                                                <form action="{{ route('Astoring.store', $malfunction->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <select
                                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        name="monteur" id="monteur">
                                                        <option value="">-- select a option --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-primary-button type="submit">
                                                        Monteur inplannen
                                                    </x-primary-button>
                                                </form>
                                            @else
                                                Deze storing heeft al een monteur
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            @foreach ($malfunctions as $malfunction)
                                @if ($malfunction->MalfunctionsHandling[0]->user_id == Auth::user()->id)
                                    @if ($malfunction->emergency == true)
                                        <tr class="bg-red-400">
                                            <th scope="row" class="px-6 py-4 text-white">
                                                {{ $malfunction->description }}
                                            </th>
                                            <td class="px-6 py-4 text-white">
                                                {{ $malfunction->space }}
                                            </td>
                                            <td class="px-6 py-4 text-white">
                                                {{ $malfunction->Tenants->firstname }}
                                            </td>
                                            <td class="px-6 py-4 text-white">
                                                {{ $malfunction->Tenants->Properties[0]->street }}
                                                {{ $malfunction->Tenants->Properties[0]->house_number }}
                                            </td>
                                            <td class="px-6 py-4 text-white">
                                                {{ $malfunction->Status->name }}
                                            </td>
                                            <td class="px-6 py-4 text-white">
                                                <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                    href="{{ route('StoringH.create', $malfunction->id) }}">Storing
                                                    afhandelen</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="px-6 py-4">
                                                {{ $malfunction->description }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $malfunction->space }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $malfunction->Tenants->firstname }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $malfunction->Tenants->Properties[0]->street }}
                                                {{ $malfunction->Tenants->Properties[0]->house_number }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $malfunction->Status->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                    href="{{ route('StoringH.create', $malfunction->id) }}">Storing
                                                    afhandelen</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @php
        header('Refresh: 30');
    @endphp
</x-app-layout>
