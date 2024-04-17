<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}}</title>
    <link rel="icon" href="{{ url('images/icon-2.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="antialiased">
    <div
        class="block max-w-[18rem] rounded-lg bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white">
        <div class="relative overflow-hidden bg-cover bg-no-repeat">
            <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/nature/182.jpg" alt="" />
        </div>
        <div class="p-6">
            <p class="text-base">
                Some quick example text to build on the card title and make up the
                bulk of the card's content.
            </p>
        </div>
    </div>
</body>

</html>
