<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script defer data-domain="digirare.com" src="https://plausible.io/js/plausible.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">

@if(! empty($_GET))
    <meta name="robots" content="noindex,follow">
@endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body id="{{ session()->get('nightmode') === 'true' ? 'nightmode' : '' }}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-diamond text-highlight" aria-hidden="true"></i>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <ul class="navbar-nav ml-auto mr-3 d-inline-block d-md-none">
                    <li class="nav-item">
                        <a href="{{ route('random.index') }}" class="nav-link">
                            <i aria-hidden="true" class="fa fa-random"></i>
                            {{ __('Random') }}
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cards.index') }}">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                {{ __('Browse') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                <i class="fa fa-gavel" aria-hidden="true"></i>
                                {{ __('Market') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('matches.index') }}">
                                <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                {{ __('Trades') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('artists.index') }}">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                {{ __('Artists') }}
                            </a>
                        </li>
                        <li class="nav-item d-none d-lg-inline-block">
                            <a class="nav-link" href="{{ route('pages.rankings') }}">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                {{ __('Rankings') }}
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.youtube.com/watch?v=0MBEW2NxNJ4" target="_blank">
                                {{ __('How it Works') }}
                            </a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    {{ __('Sign up') }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ config('digirare.telegram_url') }}" target="_blank">
                                    {{ __('Support') }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i aria-hidden="true" class="fa fa-user"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        {{ __('Account') }}
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        {{ __('Upgrade') }}
                                    </a>                  
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sign out') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('jumbotron')

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="container text-center text-muted pb-5">
            <a href="{{ route('home.index') }}" class="mr-2">
                {{ __('Home') }}
            </a>
            <a href="https://21e14.com/" class="mr-2" target="_blank">
                {{ __('About Us') }}
            </a>
            <a href="{{ config('digirare.tutorial_url') }}" class="mr-2" target="_blank">
                {{ __('Tutorial') }}
            </a>
            <a href="{{ config('digirare.github_url') }}" class="mr-2" target="_blank">
                {{ __('GitHub') }}
            </a>
            <a href="{{ config('digirare.telegram_url') }}" target="_blank">
                {{ __('Telegram') }}
            </a>
            <small class="d-block" style="font-size: 11px">
                &copy; 21e14.com
                <a href="https://plausible.io/digirare.com" class="text-muted mr-1" target="_blank">
                    {{ __('Analytics') }}
                </a>
                <a href="{{ route('pages.disclaimer') }}" class="text-muted mr-1">
                    {{ __('Disclaimer') }}
                </a>
                <a href="{{ route('pages.privacy') }}" class="text-muted mr-1">
                    {{ __('Privacy') }}
                </a>
                <a href="{{ route('pages.terms') }}" class="text-muted">
                    {{ __('Terms') }}
                </a>
            </small>
        </footer>

    </div>

</body>
</html>
