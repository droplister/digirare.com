<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                            <a class="nav-link" href="#">
                                <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                {{ __('Trades') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                                {{ __('Charts') }}
                            </a>
                        </li>
                        <li class="nav-item d-none d-lg-inline-block">
                            <a href="{{ route('random.index') }}" class="nav-link">
                                <i aria-hidden="true" class="fa fa-random"></i>
                                {{ __('Random') }}
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://medium.com/@droplister/counterparty-dex-tutorial-b38dcab102e5" target="_blank">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i aria-hidden="true" class="fa fa-user"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ config('digirare.telegram_url') }}">
                                        {{ __('Support') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Log out') }}
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

        <footer class="container text-center text-muted pb-4">
            <a href="{{ url('/') }}" class="mr-2">{{ __('Home') }}</a>
            <a href="{{ route('pages.investors') }}" class="mr-2">{{ __('Investors') }}</a>
            <a href="https://medium.com/@droplister/counterparty-dex-tutorial-b38dcab102e5" class="mr-2" target="_blank">{{ __('Tutorial') }}</a>
            <a href="https://github.com/droplister/digirare.com"  class="mr-2" target="_blank">{{ __('GitHub') }}</a>
            <a href="https://t.me/digirare" target="_blank">{{ __('Telegram') }}</a>
            <small class="d-block" style="font-size: 11px">
                &copy; 2018
                <a href="https://familymediallc.com/" class="text-muted mr-1" target="_blank">Family Media</a>
                <a href="{{ config('digirare.analytics') }}" class="text-muted mr-1" target="_blank">{{ __('Analytics') }}</a>
                <a href="{{ route('pages.disclaimer') }}" class="text-muted mr-1">{{ __('Disclaimer') }}</a>
                <a href="{{ route('pages.privacy') }}" class="text-muted mr-1">{{ __('Privacy') }}</a>
                <a href="{{ route('pages.terms') }}" class="text-muted">{{ __('Terms') }}</a>
            </small>
        </footer>

    </div>

<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('digirare.google_ua') }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '{{ config('digirare.google_ua') }}');
</script>

</body>
</html>
