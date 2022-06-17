<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('header')
</head>
<body id="body-pd" class="body-pd">

<header class="header body-pd" id="header">
    <div class="header_toggle">
        <i class='bi bi-x bi-list' id="header-toggle"></i>
    </div>
    @guest
    @else
        <div class="d-flex justify-content-center align-items-center">
            <div class="header_img me-3">
                <img alt="{{ Auth::user()->name }}" class="rounded-circle" width="45" height="45" src="/uploads/avatars/{{ Auth::user()->avatar }}">
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li>
                        <a class="dropdown-item d-flex justify-content-start align-items-center me-2" href="{{ route('profile-user') }}">
                            <i class='bi bi-person-circle nav_icon me-2'></i> Profil
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex justify-content-start align-items-center me-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='bi bi-box-arrow-left nav_icon me-2'></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>

    @endguest
</header>

<div class="l-navbar menu-show" id="nav-bar">
    <nav class="nav">
        @guest
            <div>
                <a href="/" rel="nofollow" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">Strona główna</span> </a>
                <div class="nav_list">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="nav_link"> <i class='bi bi-box-arrow-in-right nav_icon'></i>
                            <span class="nav_name">{{ __('Login') }}</span> </a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav_link">
                            <i class='bi bi-person-plus nav_icon'></i> <span class="nav_name">{{ __('Register') }}</span>
                        </a>
                    @endif
                </div>
            </div>
        @else
            @include('backend.partials.sidebar')
        @endguest
    </nav>
</div>


<div class="vh-100 bg-light pt-1">
    @yield('content')
</div>


<script src="{{ asset('js/app.js') }}"></script>
@yield('javascript')
@yield('js-files')
</body>
</html>
