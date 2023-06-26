<?php $opcion = ''?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    </style>
</head>
<body>
    <div id="app">
        <!-- ESTE APARTADO ES EL LA BARRA QUE SE MUESTRA ARRIBITA -->
        <nav id="dezliz-sombra" class="desliz-sombrita shadow-sm navbar navbar-expand-lg fixed-top bg-body-tertiary">
            <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Booking Hive</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                    @auth
                            @if (auth()->user()->rol == 'G')
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{route('cuentas')}}">Administrar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="https://marketingplatform.google.com/intl/es/about/analytics/">Rendimiento</a>
                            </li>
                            @endif
                        @endauth
                        
                        @auth
                            @if (auth()->user()->rol == 'M')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('graficas')}}">Gráficas</a>
                                </li>
                            
                                <!-- ESTOS DOS ULTIMOS NO VAN. - PUES ESTOS SERÁN BOTONES O ENLACES PARA DIRIGIERNOS AL PERFIL OFICIAL DEL HOTEL Y A REALIZAR LA RESERVACIÓN -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('hotel'),Auth::user()->id}}">Hotel</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{route('reservacion')}}">Reservación</a>
                                </li> -->
                            @endif
                        @endauth
                </ul>
                <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <pre>     </pre> 
                <ul class="navbar-nav mb-2 mb-lg-0">
                    
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('perfil',Auth::user()->id)}}">
                                Configuración
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>    
                    @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Log in</a></li>

                    @if (Route::has('register'))
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                        @endif
                    @endauth
                
                    @endif
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br/><br/><br/>
        
        
        <!-- ESTE ES EL CONTENIDO QUE SE MUESTRA - TIENES QUE ESTAR LOGEADO -->
        <div class="">
            <div class="container-fluid d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">                    
                  <button class="nav-link active" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="true">Lobby</button>
                  <button class="nav-link" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="false">Usuarios</button>
                  <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Hoteles</button>
                  <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                </div>
                
                
                <div class="tab-content row container-fluid" id="v-pills-tabContent">
                    <div class="col-12 mx-auto tab-pane fade show active" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                        <div class="row">
                            <main class='col-lg-11 col-md-7 col-lg-6 mx-auto'>
                                <br/>
                                @include('admin.cwelcome')
                            
                            </main>
                        </div>
                      </div>
                  
                    <div class="col-12 mx-auto tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab " tabindex="0">
                    <div class="row">
                        <main class='col-lg-11 col-md-7 col-lg-6 mx-auto'>
                            
                            <br/>
                            @include('admin.cusers')
                            
                        </main>
                    </div>
                  </div>
                  <div class="col-12 mx-auto tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                    <div class="row "">
                        <main class='col-lg-11 col-md-7 col-lg-6 mx-auto'>
                            <br/>
                            @include('admin.chotels')
                        
                        </main>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                    <div class="row "">
                        <main class='col-lg-11 col-md-7 col-lg-6 mx-auto'>
                            
                            <p>En este apartado no se que Poner XD </p>
                        
                        </main>
                    </div>
                  </div>
                </div>
              </div>

        </div>
    </div>


    <!-- Ventanas flotantes -->

    

    <!-- por si acaso no funciona algo -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="sweetalert2/dist/weetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

