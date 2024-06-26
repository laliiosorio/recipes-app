<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <main class="bg-slate-400 min-h-screen">
        @include('components.navbar')

        <section class="mx-auto max-w-7xl mt-9 px-4 sm:px-6 lg:px-8 md:flex justify-center items-center">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($allRecipes as $recipe)
                @php
                $instruction_words = str_word_count($recipe->instructions, 1);
                $instruction_preview = implode(' ', array_slice($instruction_words, 0, 15));
                @endphp
                <a href="{{ route('recipe.show', $recipe->id) }}" class="hover:shadow-lg">
                    <div class="bg-white rounded-md overflow-hidden relative shadow-md">
                        <div>
                            <img class="w-full h-48 object-cover"
                                src="{{ asset('images/' . (file_exists(public_path('images/' . $recipe->image)) ? $recipe->image : 'poke.webp')) }}"
                                alt="{{ $recipe->name }}">
                        </div>
                        <div class="p-4">
                            <h2 class="text-2xl text-green-400">{{ $recipe->name }}</h2>
                            <div class="flex justify-between mt-4 mb-4 text-gray-500">
                                <div class="flex items-center text-green-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="ml-1 text-lg">{{ $recipe->preparation_time }}m</span>
                                </div>
                                <div class="flex items-center">
                                    @foreach ($recipe->categories as $category)

                                    <span
                                        class="ml-1 text-lg font-bold text-green-700">{{ ucfirst($category->name) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <p class="mb-4 text-gray-500 h-24">{{ $instruction_preview }}...</p>
                            <div class="text-green-700 flex justify-self-end items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2 0a2 2 0 00-2 2v16a2 2 0 002 2h16a2 2 0 002-2V2a2 2 0 00-2-2H2zm1 4a1 1 0 011-1h12a1 1 0 011 1v1H2V4zm0 4h16v10H2V8zm4-4a1 1 0 00-1 1v2a1 1 0 002 0V9a1 1 0 00-1-1zm6 0a1 1 0 00-1 1v2a1 1 0 002 0V9a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span
                                    class="text-gray-500">{{ \Carbon\Carbon::parse($recipe->publish_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        <div
                            class="absolute top-0 right-0 mt-4 mr-4 bg-green-400 text-white rounded-full pt-1 pb-1 pl-4 pr-5 text-xs uppercase">
                            <span>{{ ucfirst($recipe->difficulty) }}</span>
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </section>

        <footer class="py-16 text-center text-sm text-black dark:text-white/70">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>

    </main>
</body>

</html>