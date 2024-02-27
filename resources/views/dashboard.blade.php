<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    {{ __('Huurder') }}
                </div>
            </div>
        </div>
        @if (Auth::check())

            {{-- Admin --}}
            @if (Auth::user()->role_id == 1)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 ">
                            {{ __('Admin') }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Helpdesk --}}
            @if (Auth::user()->role_id == 2)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 ">
                            {{ __('Helpdesk') }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Monteur --}}
            @if (Auth::user()->role_id == 3)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 ">
                            {{ __('Monteur') }}
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
