<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    @stack('styles')

    <style>
        body {
            background-color: #eaeaea;
        }
        .bg-navbar {
            color: #efefef !important;
            background: rgb(23, 56, 106);
            background: linear-gradient(45deg, rgba(23, 56, 106, 1) 0%, rgba(29, 173, 254, 1) 100%);
        }

        .bg-navbar .navbar-brand {
            color: #efefef !important;
        }

        .bg-navbar .dropdown-toggle {
            color: #efefef;
        }
    </style>

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100 bg-auth">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6" style="background-image: url('{{ asset('images/bg-auth.jpg') }}'); background-size: cover; background-position: center" ></div>
                        <div class="col-md-6 p-4">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
