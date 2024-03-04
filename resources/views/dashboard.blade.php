<x-app-layout>
    <style>
        body {
            overflow    : hidden;
            margin      : 0;
        }

        .banner {
            display         : flex;
            align-items     : center;
            justify-content : center;
            flex-direction  : column-reverse;
            gap             : 50px;
            padding         : 0 80px;
            text-align      : center;
            height          : 100vh;
        }

        .banner h2 {
            font-weight : 500;
            font-size   : 30px;
            margin      : 0 0 10px;
        }

        .banner p {
            margin      : 0;
            line-height : 1.65;
            font-size   : 17px;
            opacity     : 0.7;
        }

        @media (width >= 648px) {
            .banner {
                text-align      : left;
                flex-direction  : row;
                justify-content : space-between;
            }
        }

        .waves > use {
            animation : move-forever 2s -2s linear infinite;
        }

        .waves > use:nth-child(2) {
            animation-delay    : -5s;
            animation-duration : 8s;
        }

        .waves > use:nth-child(3) {
            animation-delay    : -6s;
            animation-duration : 5s;
        }

        @keyframes move-forever {
            0% {
                transform : translate(-90px, 0%);
            }
            100% {
                transform : translate(85px, 0%);
            }
        }

        .svgDashboard {
            position   : absolute;
            left       : 0;
            bottom     : 0;
            width      : 100%;
            height     : 30vw;
            max-height : 200px;
        }
    </style>
    <body>
        <section class="banner">
            <div class="banner-content">
                <h2>Welkom bij RentIT</h2>
                <p>
                    Bedrijfsinfo
                </p>
            </div>
        </section>

        <svg class="svgDashboard"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28"
            preserveAspectRatio="none"
        >
            <defs>
                <path
                    id="gentle-wave"
                    d="M-160 44c30 0
        58-18 88-18s
        58 18 88 18
        58-18 88-18
        58 18 88 18
        v44h-352z"
                />
            </defs>
            <g class="waves">
                <use
                    xlink:href="#gentle-wave"
                    x="50"
                    y="0"
                    fill="#FF1E1F"
                    fill-opacity=".2"
                />
                <use
                    xlink:href="#gentle-wave"
                    x="50"
                    y="3"
                    fill="#FF1E1F"
                    fill-opacity=".5"
                />
                <use
                    xlink:href="#gentle-wave"
                    x="50"
                    y="6"
                    fill="#FF1E1F"
                    fill-opacity=".9"
                />
            </g>
        </svg>
    </body>
</x-app-layout>
