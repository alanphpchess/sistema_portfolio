<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> TechError - Error Pages Tailwind CSS 3 HTML Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="TechError - Error Pages Tailwind CSS 3 HTML Template, It’s fully responsive and built Tailwind v3" name="description" />
    <meta content="Techzaa" name="author" />
    <!-- favicon -->
    {{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}

    <!-- Style css -->
    <link href="{{ asset('css/default/page404.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
</head>

<body>

    <section class="flex items-center h-full">
        <div class="container">
            <div class="text-center max-w-2xl mx-auto">
                <img src="{{ asset('image/page404/img-404.png') }}" alt="error-5" class="h-72 mb-5 mx-auto">
                <h1 class="font-bold sm:text-[150px] text-9xl mb-2">404</h1>
                <h3 class="text-gray-800 sm:text-2xl text-xl font-bold mb-4">Opps! Página não encontrada</h3>
                <p class="text-gray-700 font-medium leading-relaxed">Página não encontrada</p>
                <div class="mt-8">
                    <button class="border border-black text-black font-medium rounded-full transition-all duration-300 hover:bg-black hover:text-white py-3 px-7">Voltar</button>
                </div>

            </div>
        </div>
    </section>

</body>

</html>