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
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-diamond" aria-hidden="true"></i>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <ul class="navbar-nav ml-auto mr-3 d-inline-block d-md-none">
                    <li class="nav-item">
                        <a href="https://digirare.com/random" class="nav-link">
                            <i aria-hidden="true" class="fa fa-random text-highlight"></i>
                            Random
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
                                <i class="fa fa-chain" aria-hidden="true"></i>
                                {{ __('XCP Cards') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('collections.index') }}">
                                <i class="fa fa-image" aria-hidden="true"></i>
                                {{ __('Collections') }}
                            </a>
                        </li>
                        <li class="nav-item d-none d-lg-inline-block">
                            <a class="nav-link" href="{{ route('random.index') }}">
                                <i class="fa fa-random" aria-hidden="true"></i>
                                {{ __('Randomize') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('artists.index') }}">
                                    <i aria-hidden="true" class="fa fa-paint-brush"></i>
                                    Artists
                                </a>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i aria-hidden="true" class="fa fa-list"></i>
                                    Big Board
                                </a>
                                <a class="dropdown-item" href="{{ route('collectors.index') }}">
                                    <i aria-hidden="true" class="fa fa-hand-grab-o"></i>
                                    Collectors
                                </a>
                            </div>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ config('digirare.telegram_url') }}">
                                    {{ __('Support') }}
                                </a>
                            </li>
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

        <main class="pt-4">
            @yield('content')
        </main>

        <footer class="container text-center text-muted pb-4">
            <hr />
            <a href="{{ url('/') }}" class="mr-2">Home</a>
            <a href="{{ route('pages.investors') }}" class="mr-2">Investors</a>
            <a href="https://github.com/droplister/digirare.com"  class="mr-2" target="_blank">GitHub</a>
            <a href="https://medium.com/@droplister/counterparty-dex-tutorial-b38dcab102e5" class="mr-2" target="_blank">Tutorial</a>
            <a href="https://t.me/digirare" target="_blank">Telegram</a>
            <small class="d-block">
                &copy; 2018
                <a href="https://familymediallc.com/" class="text-muted mr-3" target="_blank">Family Media LLC</a>
                <a href="{{ route('pages.disclaimer') }}" class="text-muted mr-2">Disclaimer</a>
                <a href="{{ route('pages.privacy') }}" class="text-muted mr-2">Privacy</a>
                <a href="{{ route('pages.terms') }}" class="text-muted">Terms</a>
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
