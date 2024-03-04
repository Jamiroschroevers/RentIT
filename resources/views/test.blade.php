<x-app-layout>
    @if (session()->has('message'))
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:text-green-400"
             role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">{{ session()->get('message') }}</span>
            </div>
        </div>
    @endif
    <style>
        .huurwoningSection {
            min-height      : 100vh;
            display         : flex;
            justify-content : center;
            align-items     : center;
        }

        .huurwoningH1 {
            font-size : 3rem;
            margin    : 20px;
        }

        .huurwoningH2 {
            font-size      : 40px;
            text-align     : center;
            text-transform : uppercase;
        }

        @media (max-width : 900px) {
            section h1 {
                font-size  : 2rem;
                text-align : center;
            }

            section .text-container {
                flex-direction : column;
            }
        }

        .reveal {
            position   : relative;
            transform  : translateY(150px);
            opacity    : 0;
            transition : 2s all ease;
        }

        .reveal.active {
            transform : translateY(0);
            opacity   : 1;
        }
    </style>
    <section class="huurwoningSection">
        <div class="container reveal">
            <h1 class="huurwoningH1">Scroll om alle huurwoning te zien &#8595;</h1>
        </div>
    </section>
    <section class="huurwoningSection">
        <div class="container reveal">
            <h2 class="huurwoningH2">Huurwoning</h2>
            <div class="flex justify-between">
                @if(Auth::user()->role_id === 1)
                    <div class="flex justify-end items-center">
                        <x-primary-button id="openModal" class="mr-5">Huurwoning Toevoegen</x-primary-button>
                    </div>
                @endif
            </div>
            <style>
                .parent {
                    width       : 300px;
                    padding     : 20px;
                    perspective : 1000px;
                }

                .card {
                    padding-top         : 50px;
                    /* border-radius: 10px; */
                    border              : 3px solid rgb(255, 255, 255);
                    transform-style     : preserve-3d;
                    background          : linear-gradient(135deg, #0000 18.75%, #f3f3f3 0 31.25%, #0000 0),
                    repeating-linear-gradient(45deg, #f3f3f3 -6.25% 6.25%, #ffffff 0 18.75%);
                    background-size     : 60px 60px;
                    background-position : 0 0, 0 0;
                    background-color    : #f0f0f0;
                    width               : 100%;
                    box-shadow          : rgba(142, 142, 142, 0.3) 0px 30px 30px -10px;
                    transition          : all 0.5s ease-in-out;
                }

                .card:hover {
                    background-position : -100px 100px, -100px 100px;
                    transform           : rotate3d(0.5, 1, 0, 30deg);
                }

                .content-box {
                    background      : rgba(255, 30,	31, 0.732);
                    transition      : all 0.5s ease-in-out;
                    padding         : 60px 25px 25px 25px;
                    transform-style : preserve-3d;
                }

                .content-box .card-title {
                    display     : inline-block;
                    color       : white;
                    font-size   : 25px;
                    font-weight : 900;
                    transition  : all 0.5s ease-in-out;
                    transform   : translate3d(0px, 0px, 50px);
                }

                .content-box .card-title:hover {
                    transform : translate3d(0px, 0px, 60px);
                }

                .content-box .card-content {
                    margin-top  : 10px;
                    font-size   : 12px;
                    font-weight : 700;
                    color       : #f2f2f2;
                    transition  : all 0.5s ease-in-out;
                    transform   : translate3d(0px, 0px, 30px);
                }

                .content-box .card-content:hover {
                    transform : translate3d(0px, 0px, 60px);
                }

                .content-box .see-more {
                    cursor         : pointer;
                    margin-top     : 1rem;
                    display        : inline-block;
                    font-weight    : 900;
                    font-size      : 9px;
                    text-transform : uppercase;
                    color          : #FF1E1F;
                    /* border-radius: 5px; */
                    background     : white;
                    padding        : 0.5rem 0.7rem;
                    transition     : all 0.5s ease-in-out;
                    transform      : translate3d(0px, 0px, 20px);
                }

                .content-box .see-more:hover {
                    transform : translate3d(0px, 0px, 60px);
                }

                .date-box {
                    position   : absolute;
                    top        : 30px;
                    right      : 30px;
                    height     : 60px;
                    width      : 60px;
                    background : white;
                    border     : 1px #FF1E1F;
                    /* border-radius: 10px; */
                    padding    : 10px;
                    transform  : translate3d(0px, 0px, 80px);
                    box-shadow : rgba(100, 100, 111, 0.2) 0px 17px 10px -10px;
                }

                .date-box span {
                    display    : block;
                    text-align : center;
                }

                .date-box .date {
                    font-size   : 20px;
                    font-weight : 900;
                    color       : rgb(4, 193, 250);
                }
            </style>
            <div class="flex flex-wrap ml-5">
                @foreach ($properties as $property)
                    <div class="parent">
                        <div class="card">
                            <div class="content-box">
                                <span class="card-title">{{ $property->city }}</span>
                                <p class="card-content">
                                    {{ $property->street }}, {{ $property->postal_code }}
                                </p>
                                <p class="card-content">
                                    Huisnummer: {{ $property->house_number }}
                                </p>
                                <p class="card-content">
                                    Status: {{ $property->status->name }}
                                </p>
                                <p class="card-content">
                                    Huurder: {{ $property->tenant_id !== null ? $property->Tenants->firstname . ' '. $property->Tenants->lastname : 'Nog geen huurder toegevoegd' }}</p>
                                </p>

                                <div class="date-box">
                                    <span class="date">
                                        <img src="{{ asset('img/icons8-house.png') }}" width="36px" height="36px">
                                    </span>
                                </div>
                                <a class="flex justify-end" href="{{ route('property.show', $property) }}">
                                    <span class="see-more">See More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        function reveal() {
            var reveals = document.querySelectorAll('.reveal')

            for (var i = 0; i < reveals.length; i ++) {
                var windowHeight   = window.innerHeight
                var elementTop     = reveals[i].getBoundingClientRect().top
                var elementVisible = 150

                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add('active')
                } else {
                    reveals[i].classList.remove('active')
                }
            }
        }

        window.addEventListener('scroll', reveal)
        reveal()
    </script>
    <div id="myModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white shadow-md rounded-lg p-8 w-96 mx-auto">
            <header>
                <h2 class="text-2xl font-semibold mb-4">Huurwoning aanmaken</h2>
            </header>
            <style>
                .input-enabled {
                    background-color : #fff;
                }

                .input-disabled {
                    background-color : #ffeeba;
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

                .button::before, .button::after {
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

                .button:hover::before, .button:hover::after {
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

            <form action="{{ route('property.store') }}" method="post" class="flex flex-col space-y-4" enctype="multipart/form-data">
                @csrf
                <label for="name" class="text-black">Postcode:</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" autofocus class="border-gray-300 rounded-md shadow-sm input">
                @error('postal_code')
                <div class="text-red-700 mt-2">{{ $message }}</div>
                @enderror

                <label for="name" class="text-black">Straat:</label>
                <input type="text" name="street" id="street" value="{{ old('street') }}" class="border-gray-300 rounded-md shadow-sm input input-enabled">
                @error('street')
                <div class="text-red-700 mt-2">{{ $message }}</div>
                @enderror

                <label for="name" class="text-black">Stad:</label>
                <input type="text" name="city" id="city" value="{{ old('city') }}"
                       class="border-gray-300 rounded-md shadow-sm input input-enabled">
                @error('city')
                <div class="text-red-700 mt-2">{{ $message }}</div>
                @enderror

                <label for="name" class="text-black">Huisnummer:</label>
                <input type="text" name="house_number" id="house_number" value="{{ old('house_number') }}" class="border-gray-300 rounded-md shadow-sm input">
                @error('house_number')
                <div class="text-red-700 mt-2">{{ $message }}</div>
                @enderror

                <button class="button">
                    Aanmaken
                </button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#postal_code').on('input', function () {
                var postcode = $(this).val().replace(/\s/g, '')
                if (postcode.length >= 6) {
                    $.ajax({
                        url: '/get-address/' + postcode,
                        type: 'GET',
                        data: {postcode: postcode},
                        success: function (data) {
                            const city = document.getElementById('city')
                            city.value = data.city
                            city.classList.remove('input-enabled')
                            city.classList.add('input-disabled')

                            const street = document.getElementById('street')
                            street.value = data.street
                            street.classList.remove('input-enabled')
                            street.classList.add('input-disabled')
                        }
                    })
                } else {
                    const city = document.getElementById('city')
                    city.value = ''
                    city.classList.remove('input-disabled')
                    city.classList.add('input-enabled')

                    const street = document.getElementById('street')
                    street.value = ''
                    street.classList.remove('input-disabled')
                    street.classList.add('input-enabled')
                }
            })
        })
        document.getElementById('openModal').addEventListener('click', function () {
            document.getElementById('myModal').classList.remove('hidden')
        })

        // Close modal when clicking outside of it
        document.getElementById('myModal').addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.add('hidden')
            }
        })
    </script>
</x-app-layout>
