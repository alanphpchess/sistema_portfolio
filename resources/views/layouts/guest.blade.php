<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">


    <!-- Temas -->
    <link href="{{ asset('theme/login/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/login/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/login/iofrm-style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/login/iofrm-theme13.css') }}" rel="stylesheet" type="text/css" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="form-body">
    <div class="website-logo">
        <a href="index.html">
            <div class="logo">
                <img class="logo-size" src="images/logo-light.svg" alt="">
            </div>
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                {{-- <h3>Get more things done with Loggin platform.</h3>
                <p>Access to the most powerfull tool in the entire design and web industry.<br><br>
                    Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod
                    maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p> --}}
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content" style="display: flex;flex-direction: column;">
                <div>
                    <!-- <img class="h-8 mx-auto" src=""
                        alt="images" style="width:30%;margin-bottom:20px"> -->
                </div>
                <div class="form-items">
                    <div class="page-links">
                        <a href="/login">Login</a>
                        {{-- <a href="/register">Registrar</a> --}}
                    </div>
                    {{ $slot }}

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('theme/login/jquery.min.js') }}"></script>
<script src="{{ asset('theme/login/popper.min.js') }}"></script>
<script src="{{ asset('theme/login/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/login/main.js') }}"></script>
</body>


</html>
