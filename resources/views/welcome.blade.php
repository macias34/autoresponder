<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ada - A Tailus template</title>
    <meta name="description" content="Modern landing page built with tailus themer"/>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" media="(prefers-color-scheme: light)"/>
    <link rel="icon" type="image/svg+xml" href="/darkfavicon.svg" media="(prefers-color-scheme: dark)"/>

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://ada.tailus.io/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="WebSharper"/>
    <meta property="og:description" content="Modern landing page built with tailus themer"/>
    <meta property="og:image" content="/og-cover.png"/>

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="twitter:domain" content="ada.tailus.io"/>
    <meta property="twitter:url" content="https://ada.tailus.io/"/>
    <meta name="twitter:title" content="Tailus Ada"/>
    <meta name="twitter:description" content="Modern landing page built with tailus themer"/>
    <meta name="twitter:image" content="/og-cover.png"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="bg-white dark:bg-gray-900 dark:before:fixed dark:before:-z-50 dark:before:inset-0 dark:before:bg-gray-950/50">
<header>

</header>
<main class="overflow-hidden">
    <div
        class="text-center sm:mx-auto sm:w-10/12 lg:mr-auto lg:mt-0 lg:w-4/5 absolute top-[40%] left-1/2 -translate-x-1/2 -translate-y-1/2">
        <h1 class="mt-8 text-wrap text-4xl md:text-5xl font-semibold text-gray-950 dark:text-white xl:text-5xl xl:[line-height:1.125]">
            Artificial Intelligence <br class="hidden sm:block"> Autoresponder</h1>
        <p class="text-wrap mx-auto mt-8 max-w-2xl text-lg text-gray-700 dark:text-gray-300 hidden sm:block">
            Replying to Customer Emails is tedious, let us automate it with AI.
        </p>
        <p class="text-wrap mx-auto mt-6 max-w-2xl text-gray-700 dark:text-gray-300 sm:hidden">Highly
            customizable components for building modern websites and applications, with your personal
            spark.</p>
        <div class="mt-8 flex flex-col items-center justify-center gap-4">
            <a href="{{route('dashboard')}}">
                <x-primary-button>Get started</x-primary-button>
            </a>
        </div>
    </div>


</main>


<script type="module" src="./main.js"></script>
<script type="module">
    import Swiper from 'swiper/bundle';
    import {Pagination} from 'swiper/modules';
    import 'swiper/css/bundle';
    import 'swiper/css/pagination';
    import 'swiper/css/effect-cards'

    const swiper = new Swiper('.proofSlides', {
        effect: "cube",
        cubeEffect: {
            slideShadows: false,
            shadow: false,
            shadowOffset: 20,
            shadowScale: 0.94,
        },
        loop: true,
        autoplay: {
            delay: 3000,
            duration: 500
        },
        grabCursor: true,
        modules: [Pagination],
        centeredSlides: true,
        pagination: {
            el: '.swiper-pagination',
        }
    });
</script>
</body>
</html>
