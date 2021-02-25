<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ __('Login')
                                }}</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('managers.login') }}">
                                    {{ __('Login Managers') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('drivers.login') }}">
                                    {{ __('Login Drivers') }}
                                </a>
                            </div>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (Auth::guard('admin')->check())
                                {{ Auth::guard('admin')->user()->name }}
                                @elseif(Auth::guard('manager')->check())
                                {{ Auth::guard('manager')->user()->name }}
                                @elseif(Auth::guard('driver')->check())
                                {{ Auth::guard('driver')->user()->name }}
                                @endif
                            </a>

                            @if (Auth::guard('admin')->check())
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                            @elseif(Auth::guard('manager')->check())
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('managers.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('managers-logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="managers-logout-form" action="{{ route('managers.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                            @elseif(Auth::guard('driver')->check())
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('drivers.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('drivers-logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="drivers-logout-form" action="{{ route('drivers.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                            @endif
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
