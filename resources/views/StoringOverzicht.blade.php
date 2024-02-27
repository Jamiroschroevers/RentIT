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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($malfunctions as $malfunction)
                            @if ($malfunction->emergency == true)
                                <tr class="bg-red-400 border-b">
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
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @php
        header('Refresh: 30');
    @endphp
</x-app-layout>
