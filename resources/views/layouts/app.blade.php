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
            height: 100vh;
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
    <nav class="navbar navbar-expand-lg bg-navbar fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><button type="submit" form="logout-form" class="dropdown-item">Logout</button></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container h-100">
        <div class="row h-100">
            <aside class="col-auto" style="padding-top: 5rem">
                <nav>
                    <ul class="nav flex-column align-items-end">
                        <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="{{ route('trips.index') }}" class="nav-link">Drivers on shift</a></li>
                        <li class="nav-item"><a href="{{ route('orders.index') }}" class="nav-link">Orders</a></li>
                        <li class="nav-item"><a href="{{ route('drivers.index') }}" class="nav-link">Drivers</a></li>
                        <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link">Users</a></li>
                        <li class="nav-item"><a href="{{ route('units.index') }}" class="nav-link">Units</a></li>
                        <li class="nav-item"><a href="{{ route('pumps.index') }}" class="nav-link">Pumps</a></li>
                        <li class="nav-item"><a href="{{ route('reports.index') }}" class="nav-link">Reports</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="col bg-white" style="padding-top: 5rem">
                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('page-title')
                @yield('content')
            </main>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    @stack('modals')
    @vite(['resources/js/app.js'])
    @stack('scripts')

    @livewireScripts
</body>

</html>
