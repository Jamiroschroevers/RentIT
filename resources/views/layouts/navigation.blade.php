<nav class="bg-white border-b border-gray-100">
    <style>
        button {
            border     : 0;
            padding    : 0;
            background : transparent;
            cursor     : pointer;
        }

        .burger,
        .menu {
            position : fixed;
        }

        .burger {
            z-index             : 3;
            top                 : -10px;
            left                : 0;
            display             : grid;
            place-items         : center;
            width               : 88px;
            height              : 88px;
            background-image    : url('{{ asset("img/menu.svg") }}');
            background-repeat   : no-repeat;
            background-position : center;
        }

        body.open .burger {
            background-image : url('{{ asset("img/close.svg") }}');;
        }

        .menu {
            z-index     : 2;
            top         : 0;
            left        : 0;
            display     : grid;
            place-items : center;
            visibility  : hidden;
            width       : 400px;
            height      : 100%;
            background  : #07030a;
            translate   : -100% 0;
            transition  : translate 0.375s cubic-bezier(0.175, 0.885, 0.32, 1);
        }

        .menu nav {
            opacity : 0;
        }

        @keyframes menu-in {
            0% {
                clip-path : ellipse(60% 60% at 0% 50%);
            }
            100% {
                clip-path : ellipse(120% 120% at 0% 50%);
            }
        }

        body.open .menu {
            opacity    : 1;
            visibility : visible;
            translate  : 0;
            animation  : menu-in 0.375s;
        }

        body.open .menu nav {
            opacity : 1;
        }

        .menu nav:hover a {
            opacity : 0.25;
        }

        .menu nav a:hover {
            opacity : 1;
        }

        .menu nav {
            display         : flex;
            flex-direction  : column;
            justify-content : center;
            align-items     : center;
        }

        .menu a {
            position        : relative;
            color           : #f9f9f9;
            font-size       : 32px;
            padding         : 20px 0;
            width           : 300px;
            text-decoration : none;
            transition      : 0.4s;
        }

        .menu a::before,
        .menu a::after {
            content       : "";
            position      : absolute;
            left          : 0;
            bottom        : 10px;
            width         : 100%;
            height        : 2px;
            border-radius : 2px;
            transition    : 0.4s;
        }

        .menu a::before {
            opacity    : 0;
            background : rgb(255 255 255 / 20%);
        }

        .menu a::after {
            transform        : scaleX(0);
            transform-origin : 0% 50%;
            background       : #f7f7f7;
        }

        .menu a:hover::before {
            opacity : 1;
        }

        .menu a:hover::after {
            transform : scaleX(1);
        }

        body.open .menu a {
            animation : appear 0.25s backwards;
        }

        @keyframes appear {
            0% {
                opacity   : 0;
                translate : -30px 0;
            }
            100% {
                opacity : 1;
            }
        }
    </style>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <button class="burger" onclick="toggleMenu()"></button>
                <div class="menu">
                    <nav>
                        <x-nav-link style="animation-delay: 0.2s" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link style="animation-delay: 0.3s" :href="route('Hstoring.index')" :active="request()->routeIs('Hstoring.index')">
                            {{ __('Storing') }}
                        </x-nav-link>
                        @if (Auth::check() && Auth::user()->role_id == 1)
                            <x-nav-link style="animation-delay: 0.4s" :href="route('Astoring.index')" :active="request()->routeIs('Astoring.index')">
                                {{ __('Storing overzicht') }}
                            </x-nav-link>
                        @endif
                        <x-nav-link style="animation-delay: 0.5s" :href="route('property.index')" :active="request()->routeIs('property.index')">
                            {{ __('Huurwoningen') }}
                        </x-nav-link>
                    </nav>
                </div>
                <script type="text/javascript">
                    const toggleMenu = () => document.body.classList.toggle('open')
                </script>

            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ __('Inloggen') }}</div>
                    </a>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @if (Auth::check())
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endif
    </div>
</nav>
