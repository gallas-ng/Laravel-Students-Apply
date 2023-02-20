<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #000;
            color: #fff;
            padding: 15px 0;
            margin-top: 10;
            }

            .contain {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
            }

            .footer-title {
            font-size: 0.8rem;
            margin: 0;
            font-family: 'Nunito', sans-serif;
            font-weight: bold;
            color: gray;
            height: 1px;
            font-style: italic;
            }
            .container img{
            size: 8px;
            width: 3%;
            max-width: 400px;
            margin: auto;
            display: block;
            }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src="https://img.freepik.com/icones-gratuites/foudre-noir-symbole-boulon_318-33936.jpg?size=626&ext=jpg&ga=GA1.2.938414909.1676740287&semt=ais" alt="logo" class="logo">
                <a class="navbar-brand" href="{{ url('/') }}">
                      Tech_Booster
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Administrateur ||</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dashboard |
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('c-p-f') }}">Nombre de candidatures par formation</a>
                            <a class="dropdown-item" href="{{ route('f-p-r') }}">Nombre de formations par référentiel</a>
                            <a class="dropdown-item" href="{{ route('c-p-s') }}">Répartition des candidatures par sexe</a>
                            <a class="dropdown-item" href="{{ route('f-p-t') }}">Répartition des formations par type</a>
                            <a class="dropdown-item" href="{{ route('t-a') }}">Tranches d'âge des candidats</a>
                            <a class="dropdown-item" href="{{ route('f-p-s') }}">Statut des formations (démarrées ou non)</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('candidats.index') }}">Liste des candidats |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('types.index') }}">Liste des types |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('referentiels.index') }}">Liste des référentiels |</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formations.index') }}">Liste des formations </a>
                        </li>
                    @endif 
                    @if(Auth::check() && Auth::user()->role == 'candidat')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('candidats.show', [Auth::user()->id]) }}">Candidatures |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('types.index') }}">Liste des types |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formations.index') }}"> Formations |</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('referentiels.index') }}">Liste des référentiels</a>
                        </li> 
                    @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">S'inscrire</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
            @yield('content')
            @yield('scripts')
            </div>
        </main>
    </div>
</body>
<footer>
        <div class="contain">
            <h3 class="footer-title">-- < / Tech_Booster > -- By @Gallas <span >2023</span></h3>
        </div>
</footer>
</html>
