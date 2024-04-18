@php
    use Illuminate\Support\Facades\Http;

    $pkmns = Http::withoutVerifying()->get('https://pokeapi.co/api/v2/pokemon/?offset=0&limit=25');

    //dd($pkmns->json()['results']);

    $pokemons = [];

    foreach ($pkmns->json()['results'] as $pkm) {
        $response = Http::withoutVerifying()->get($pkm['url']);

        $pokemon = new stdClass();

        $pokemon->nome = $response->json()['name'];
        $pokemon->id = $response->json()['id'];
        $pokemon->sprite = $response->json()['sprites']['other']['dream_world']['front_default'];

        // separa os tipos e a cor de cada tipo
        $tipos = [];
        foreach ($response->json()['types'] as $tipo) {
            if ($tipo['type']['name'] == 'normal') {
                $cor = 'gray-400';
            } elseif ($tipo['type']['name'] == 'fighting') {
                $cor = 'red-700';
            } elseif ($tipo['type']['name'] == 'fire') {
                $cor = 'orange-700';
            } elseif ($tipo['type']['name'] == 'water') {
                $cor = 'blue-600';
            } elseif ($tipo['type']['name'] == 'electric') {
                $cor = 'yellow-400';
            } elseif ($tipo['type']['name'] == 'grass') {
                $cor = 'green-600';
            } elseif ($tipo['type']['name'] == 'poison') {
                $cor = 'purple-700';
            } elseif ($tipo['type']['name'] == 'ground') {
                $cor = 'orange-400';
            } elseif ($tipo['type']['name'] == 'rock') {
                $cor = 'yellow-900';
            } elseif ($tipo['type']['name'] == 'flying') {
                $cor = 'violet-400';
            } elseif ($tipo['type']['name'] == 'psychic') {
                $cor = 'pink-600';
            } elseif ($tipo['type']['name'] == 'bug') {
                $cor = 'green-900';
            } elseif ($tipo['type']['name'] == 'ghost') {
                $cor = 'purple-900';
            } elseif ($tipo['type']['name'] == 'dragon') {
                $cor = 'indigo-900';
            } elseif ($tipo['type']['name'] == 'dark') {
                $cor = 'orange-950';
            } elseif ($tipo['type']['name'] == 'steel') {
                $cor = 'zinc-500';
            } elseif ($tipo['type']['name'] == 'fairy') {
                $cor = 'pink-400';
            }

            array_push($tipos, [$tipo['type']['name'], $cor]);
        }

        $pokemon->tipos = $tipos;

        //dd($pokemon);
        //dd($response->json());
        array_push($pokemons, $pokemon);
    }

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" href="{{ url('images/icon-2.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="antialiased">
    @include('navbar')
    
    <div class="grid grid-cols-6 gap-2">
        @foreach ($pokemons as $pokemon)
            @php
                $tipos = '';
            @endphp
            @foreach ($pokemon->tipos as $item)
                @php
                    $tipos .= $item[0] . '/';
                @endphp
            @endforeach
            <div class="block max-w-[18rem] rounded-lg bg-white text-surface shadow-secondary-1"
                data-nome="{{ $pokemon->nome }}" data-tipos="{{ $tipos }}">
                <div class="relative overflow-hidden bg-cover bg-no-repeat bg-red-100">
                    <span class="font-bold font-xl ml-2 mt-2"> {{ $pokemon->nome }} </span>
                    <span class="font-bold font-xl ml-2 mt-2"> #{{ $pokemon->id }} </span>
                    <div class="flex justify-start">
                        @foreach ($pokemon->tipos as $item)
                            <span
                                class="inline-block whitespace-nowrap rounded-full ml-1 mr-1 bg-{{ $item[1] }} px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-white ">
                                {{ $item[0] }}
                            </span>
                        @endforeach
                    </div>
                    <div class="flex justify-center align-items-center">
                        <img class="rounded-lg mt-2 mb-2 justify min-h-40 max-h-40" src="{{ $pokemon->sprite }}"
                            alt="" />
                    </div>
                </div>
                <div class="p-6 rounded-lg">
                    <p class="text-base">
                        Some quick example text to build on the card title and make up the
                        bulk of the card's content.
                    </p>
                </div>
            </div>
        @endforeach
    </div>



</body>

</html>
