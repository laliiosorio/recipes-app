<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->name }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('components.navbar')

    <main class="bg-slate-400 min-h-screen md:flex justify-center items-center ">
        @if ($recipe)
        <article class="bg-white md:my-10 pb-8 md:rounded-xl md:max-w-screen-md">
            <picture>
                <img src="{{ asset('images/' . (file_exists(public_path('images/' . $recipe->image)) ? $recipe->image : 'poke.webp')) }}"
                    alt="{{ $recipe->name }}" class="rounded-xl">
            </picture>
            <div class=" px-8 font-outfit text-wenge-brown">
                <div class="flex items-center justify-between mt-4 mb-4">
                    <h1 class="font-fancy text-4xl text-green-400">
                        {{ $recipe->name }}
                    </h1>
                    <div
                        class="h-fit mt-4 mr-4 bg-green-400 text-white rounded-full pt-1 pb-1 pl-4 pr-5 text-xs uppercase">
                        <span>{{ ucfirst($recipe->difficulty) }}</span>
                    </div>
                </div>
                <div class="flex justify-between mt-4 mb-4 text-gray-500">
                    <div class="flex items-center text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ml-1 text-lg">{{ $recipe->preparation_time }}m</span>
                    </div>
                    <div class="flex items-center">
                        <span class="ml-1 text-lg font-bold text-green-700">
                            @foreach ($recipe->categories as $category)
                            {{ $category->name }}
                            @endforeach
                        </span>
                    </div>
                    <div class="text-green-700 flex justify-self-end items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2 0a2 2 0 00-2 2v16a2 2 0 002 2h16a2 2 0 002-2V2a2 2 0 00-2-2H2zm1 4a1 1 0 011-1h12a1 1 0 011 1v1H2V4zm0 4h16v10H2V8zm4-4a1 1 0 00-1 1v2a1 1 0 002 0V9a1 1 0 00-1-1zm6 0a1 1 0 00-1 1v2a1 1 0 002 0V9a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-500">{{ date('d/m/Y', strtotime($recipe->publish_date)) }}</span>
                    </div>
                </div>
                <div class="mt-8">
                    <h3 class="font-fancy text-2xl text-nutmeg">Ingredientes</h3>
                    <ul class="list-disc marker:text-nutmeg mt-4 ml-6 text-dge-brown marker:align-middle">
                        @foreach (explode(', ', $recipe->ingredients) as $ingredient)
                        <li class="pl-4">{{ $ingredient }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-8">
                    <h3 class="font-fancy text-2xl text-nutmeg">Preparación</h3>
                    <ol class="marker:text-nutmeg marker:font-semibold marker:font-outfit list-decimal mt-4 ml-6">
                        @foreach (explode('. ', $recipe->instructions) as $instruction)
                        <li class="pl-4">{{ $instruction }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </article>
        @else
        <div class="text-center mt-8">
            <p class="text-xl font-semibold text-red-600">No se encontró la receta.</p>
        </div>
        @endif
    </main>

</body>

</html>