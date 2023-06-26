<?php use App\Models\Hotel; ?>

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
    
</head>

<body class="u-body">

    <div id="app">
      
      <!-- ESTE APARTADO ES EL LA BARRA QUE SE MUESTRA ARRIBITA -->
      <nav id="dezliz-sombra" class="desliz-sombrita shadow-sm navbar navbar-expand-lg fixed-top bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ url('/') }}">Booking Hive</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          
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
                      <a class="nav-link" href="{{route('graficas',Auth::user()->id)}}">Gráficas</a>
                    </li>
                
                    <!-- ESTOS DOS ULTIMOS NO VAN. - PUES ESTOS SERÁN BOTONES O ENLACES PARA DIRIGIERNOS AL PERFIL OFICIAL DEL HOTEL Y A REALIZAR LA RESERVACIÓN -->
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('editar-presentacion',$name)}}">Hotel</a>
                    </li>
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
                        <a class="dropdown-item" href="{{route('perfil',Auth::user()->id)}}">Configuración</a>
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
            </ul>

          </div>

        </div>
      </nav>
      <br/><br/><br/>
      
      

      <!-- ESTE ES EL CONTENIDO QUE SE MUESTRA - TIENES QUE ESTAR LOGEADO -->
      <div class="">
        <h1 class="u-align-justify u-text u-text-body-alt-color u-text-1">{{ Hotel::getFull(auth()->user()->name) }}</h1>
        <a href="{{route('reservacion',Auth::user()->id)}}">Reservación</a>
      </div>

    </div>
                
    <!-- por si acaso no funciona algo -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="sweetalert2/dist/weetalert2.all.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
