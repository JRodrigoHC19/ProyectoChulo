@php
    use App\Models\Hotel;
    use App\Models\Persona;
@endphp

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
                                        <a class="nav-link" href="{{route('graficas',$id)}}">Gráficas</a>
                                    </li>
                                
                                    <!-- ESTOS DOS ULTIMOS NO VAN. - PUES ESTOS SERÁN BOTONES O ENLACES PARA DIRIGIERNOS AL PERFIL OFICIAL DEL HOTEL Y A REALIZAR LA RESERVACIÓN -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('hotel',Auth::user()->id )}}">Hotel</a>
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

        <div class="container-fluid d-flex align-items-start">
            
            <div class="accordion col-lg-6 col-md-7 col-lg-6 mx-auto" id="accordionPanelsStayOpenExample">
                <!-- AÑADIR UN BOTN QUE COLAPSE TODAS LSO COLLAPSE - ERGONOMIA -->
                <br/><h1>Configuración del Perfil</h1><br/>
                
                <!-- 1ER BOTÓN ACORDIÓN - CAMBIAR TITULO -->
                @auth
                    @if (auth()->user()->rol == 'M' || auth()->user()->rol == 'G')
                        <div class="accordion-item">
                            
                            
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseZero" aria-expanded="false" aria-controls="panelsStayOpen-collapseZero">
                                    Actualizar Nombre Oficial del Hotel
                                </button>
                            </h2>

                            <!-- CONTENIDO DE ESTE ACORDIÓN -->
                            <div id="panelsStayOpen-collapseZero" class="accordion-collapse collapse">
                                <div class="accordion-body"><br/>

                                    <strong>This is the first item's accordion body.</strong> Se cuerda cambiar tu nombre de usaurio caada 2 dias<code>.accordion-body</code>, though the transition does limit overflow.<br/><br/>
                                    
                                    <div class="input-group mb-3">
                                        
                                        <!-- TITULO -->
                                        <div class="row g-3">
                                            <div class="col col-sm-5"><label class="form-label">Nombre Actual</label></div>
                                            <div class="col col-sm-7"><input type="text" class="form-control" value="{{ Hotel::getNombre( auth()->user()->email ) }}" disabled></div>
                                        </div>

                                        <!-- FORMULARIO -->
                                        <form class="row g-3" action="{{ route('editar-titulo', auth()->user()->email) }}" method="get">
                                            <div class=" col-sm-4"><label  class="form-label" >Nuevo Nombre</label></div>
                                            <div class="col-sm-5"><input type="text" class="form-control" name="titulo" /></div>
                                            <div class="col-1"><button type="submit" class="btn btn-primary">Actualizar</button></div>
                                        </form>

                                    </div>

                                    <strong>Recomendación. </strong> Tu nombre de usuarios debe indicarse como.... <code>.accordion-body</code>.<br/><br/>
                                
                                </div>
                            </div>

                        </div>
                    @endif
                @endauth
                

                <!-- 2DO BOTÓN ACORDIÓN - CAMBIAR NOMBRE DE USUARIO-->
                @auth
                    @if (auth()->user()->rol == 'R' || auth()->user()->rol == 'G')
                        <div class="accordion-item">
                            
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Cambiar Nombre de Usuario
                                </button>
                            </h2>
                            
                            <!-- CONTENIDO DEL ESTE ACORDIÓN -->
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                                <div class="accordion-body"><br/>
                                
                                    <strong>This is the first item's accordion body.</strong> Se cuerda cambiar tu nombre de usaurio caada 2 dias<code>.accordion-body</code>, though the transition does limit overflow.<br/><br/>
                                    <div class="input-group mb-3">
                                        <!-- TITULO -->
                                        <div class="row g-3">
                                                <div class="col col-sm-5"><label class="form-label">Usuario Actual</label></div>
                                                <div class="col col-sm-7"><input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled></div>
                                            </div>

                                        <!-- FORMULARIO -->
                                        <form class="row g-3" method="get" action="{{ route('editar-name', auth()->user()->email) }}">
                                                <div class=" col-sm-4"><label  class="form-label" >Nuevo Nombre de usuario</label></div>
                                                <div class="col-sm-5"><input type="text" class="form-control" name="name" /></div>
                                                <div class="col-1"><button type="submit" class="btn btn-primary">Aplicar Cambios</button></div>
                                        </form>
                                    </div>
                                    <strong>Recomendación. </strong> Tu nombre de usuarios debe indicarse como.... <code>.accordion-body</code>.<br/><br/>

                                </div>
                            </div>

                        </div>
                    @endif
                @endauth


                <!-- 3TO BOTÓN ACORDIÓN - CAMBIAR CONTRASEÑA-->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Actualizar Contraseña
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body"><br/>
                            
                        <strong>This is the first item's accordion body.</strong> Se cuerda cambiar tu nombre de usaurio caada 2 dias<code>.accordion-body</code>, though the transition does limit overflow.
                        <br/><br/>
                        <div class="input-group mb-3">

                            <form class="row g-3" onsubmit="validateForm(event)" action="{{ route('editar-password',auth()->user()->email) }}" method="GET">
                                
                                <div class="row mb-3">
                                    <label for="passwordInput" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                                    <div class="col-md-6">
                                        <input id="passwordInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Ingrese una contraseña">
                                        <span id="errorMessage" class="error-message"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="confirmPasswordInput" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="confirmPasswordInput" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ingrese la misma contraseña">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label  class="col-md-4 col-form-label text-md-end"></label>
                                    <div class="col-md-6"><button type="submit" class="btn btn-primary">Aplicar Cambios</button></div>
                                </div>

                            </form>

                        </div>
                        
                            
                        <strong>Recomendación. </strong> Tu nombre de usuarios debe indicarse como.... <code>.accordion-body</code>.
                    
                        <br/><br/>
                    </div>
                    </div>
                </div>
                

                <!-- 4TO BOTÓN ACORDIÓN - CAMBIAR DATOS PERSONALES-->
                @auth
                    @if (auth()->user()->rol == 'R' || auth()->user()->rol == 'G')

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                Actualizar datos personales
                            </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                <div class="accordion-body"><br/>

                                    <strong>This is the first item's accordion body.</strong> Se cuerda cambiar tu nombre de usaurio caada 2 dias<code>.accordion-body</code>, though the transition does limit overflow.
                                    <br/><br/>

                                    <form class="row g-3" method="get" action="{{ route('editar-datos-personales',auth()->user()->email) }}">
                                        
                                        <div class="col-md-6">
                                            <label for="validationDefault01" class="form-label">Nombre Completo</label>
                                            <input type="text" class="form-control" id="validationDefault01" value="{{ Persona::getNombre(auth()->user()->email) }}" name="nombres" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationDefault02" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="validationDefault02" value="{{ Persona::getApellido(auth()->user()->email) }}" name="apellidos" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Pais</label>
                                            <select class="form-select" name="pais"  required>
                                                <option disabled value="">Choose...</option>
                                                @php $lista = array(
                                                    "Afganistán",
                                                    "Albania",
                                                    "Alemania",
                                                    "Andorra",
                                                    "Angola",
                                                    "Antigua y Barbuda",
                                                    "Arabia Saudita",
                                                    "Argelia",
                                                    "Argentina",
                                                    "Armenia",
                                                    "Australia",
                                                    "Austria",
                                                    "Azerbaiyán",
                                                    "Bahamas",
                                                    "Bahrein",
                                                    "Bangladesh",
                                                    "Barbados",
                                                    "Belarús",
                                                    "Bélgica",
                                                    "Belice",
                                                    "Benin",
                                                    "Bhután",
                                                    "Bolivia",
                                                    "Bosnia y Herzegovina",
                                                    "Botswana",
                                                    "Brasil",
                                                    "Brunei Darussalam",
                                                    "Bulgaria",
                                                    "Burkina Faso",
                                                    "Burundi",
                                                    "Cabo Verde",
                                                    "Camboya",
                                                    "Camerún",
                                                    "Canadá",
                                                    "Chad",
                                                    "Chequia",
                                                    "Chile",
                                                    "China",
                                                    "Chipre",
                                                    "Colombia",
                                                    "Comoras",
                                                    "Congo",
                                                    "Costa Rica",
                                                    "Côte D'Ivoire",
                                                    "Croacia",
                                                    "Cuba",
                                                    "Dinamarca",
                                                    "Djibouti",
                                                    "Dominica",
                                                    "Ecuador",
                                                    "Egipto",
                                                    "El Salvador",
                                                    "Emiratos Árabes Unidos",
                                                    "Eritrea",
                                                    "Eslovaquia",
                                                    "Eslovenia",
                                                    "España",
                                                    "Estados Unidos de América",
                                                    "Estonia",
                                                    "Eswatini",
                                                    "Etiopía",
                                                    "Federación de Rusia",
                                                    "Fiji",
                                                    "Filipinas",
                                                    "Finlandia",
                                                    "Francia",
                                                    "Gabón",
                                                    "Gambia",
                                                    "Georgia",
                                                    "Ghana",
                                                    "Granada",
                                                    "Grecia",
                                                    "Guatemala",
                                                    "Guinea",
                                                    "Guinea Bissau",
                                                    "Guinea Ecuatorial",
                                                    "Guyana",
                                                    "Haití",
                                                    "Honduras",
                                                    "Hungría",
                                                    "India",
                                                    "Indonesia",
                                                    "Irán",
                                                    "Iraq",
                                                    "Irlanda",
                                                    "Islandia",
                                                    "Islas Marshall",
                                                    "Islas Salomón",
                                                    "Israel",
                                                    "Italia",
                                                    "Jamaica",
                                                    "Japón",
                                                    "Jordania",
                                                    "Kazajstán",
                                                    "Kenya",
                                                    "Kirguistán",
                                                    "Kiribati",
                                                    "Kuwait",
                                                    "Lesotho",
                                                    "Letonia",
                                                    "Líbano",
                                                    "Liberia",
                                                    "Libia",
                                                    "Liechtenstein",
                                                    "Lituania",
                                                    "Luxemburgo",
                                                    "Macedonia del Norte",
                                                    "Madagascar",
                                                    "Malasia",
                                                    "Malawi",
                                                    "Maldivas",
                                                    "Malí",
                                                    "Malta",
                                                    "Marruecos",
                                                    "Mauricio",
                                                    "Mauritania",
                                                    "México",
                                                    "Micronesia",
                                                    "Mónaco",
                                                    "Mongolia",
                                                    "Montenegro",
                                                    "Mozambique",
                                                    "Myanmar",
                                                    "Namibia",
                                                    "Nauru",
                                                    "Nepal",
                                                    "Nicaragua",
                                                    "Niger",
                                                    "Nigeria",
                                                    "Noruega",
                                                    "Nueva Zelandia",
                                                    "Omán",
                                                    "Paises",
                                                    "Países Bajos",
                                                    "Pakistán",
                                                    "Palau",
                                                    "Panamá",
                                                    "Papúa Nueva Guinea",
                                                    "Paraguay",
                                                    "Perú",
                                                    "Polonia",
                                                    "Portugal",
                                                    "Qatar",
                                                    "Reino Unido",
                                                    "República Árabe Siria",
                                                    "República Centroafricana",
                                                    "República de Corea",
                                                    "República de Moldova",
                                                    "República Democrática del Congo",
                                                    "República Democrática Popular Lao",
                                                    "República Dominicana",
                                                    "República Popular Democrática de Corea",
                                                    "República Unida de Tanzanía",
                                                    "Rumania",
                                                    "Rwanda",
                                                    "Saint Kitts y Nevis",
                                                    "Samoa",
                                                    "San Marino",
                                                    "San Vicente y las Granadinas",
                                                    "Santa Lucía",
                                                    "Santo Tomé y Príncipe",
                                                    "Senegal",
                                                    "Serbia",
                                                    "Seychelles",
                                                    "Sierra Leona",
                                                    "Singapur",
                                                    "Somalia",
                                                    "Sri Lanka",
                                                    "Sudáfrica",
                                                    "Sudán",
                                                    "Sudán del Sur",
                                                    "Suecia",
                                                    "Suiza",
                                                    "Suriname",
                                                    "Tailandia",
                                                    "Tayikistán",
                                                    "Timor-Leste",
                                                    "Togo",
                                                    "Tonga",
                                                    "Trinidad y Tabago",
                                                    "Túnez",
                                                    "Türkiye",
                                                    "Turkmenistán",
                                                    "Tuvalu",
                                                    "Ucrania",
                                                    "Uganda",
                                                    "Uruguay",
                                                    "Uzbekistán",
                                                    "Vanuatu",
                                                    "Venezuela",
                                                    "Viet Nam",
                                                    "Yemen",
                                                    "Zambia",
                                                    "Zimbabwe")
                                                @endphp
                                                @foreach ($lista as $pais)
                                                    <option value="{{ $pais }}" @if ($pais == Persona::getPais(auth()->user()->email) ) selected @endif>{{ $pais }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label  class="form-label">Sexo</label>
                                            <select class="form-select" name="sexo" required>
                                                <option disabled>Choose...</option>
                                                @php $lista = array("Masculino","Femenino") @endphp
                                                @foreach ($lista as $elemento)
                                                    <option value="{{ substr($elemento, 0, 1) }}" @if(substr($elemento, 0, 1) == Persona::getSexo(auth()->user()->email) ) selected @endif>{{ $elemento }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <label for="validationDefault05" class="form-label">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="validationDefault05" value="{{ Persona::getNacimiento(auth()->user()->email) }}" name="fecha" required>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="invalidCheck2" required>
                                                <label class="form-check-label" for="invalidCheck2">
                                                Agree to terms and conditions
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Submit form</button>
                                        </div>
                                    </form>

                                    <br/>
                                    <strong>Recomendación. </strong> Tu nombre de usuarios debe indicarse como.... <code>.accordion-body</code>.

                                        
                                    <br/><br/>
                                </div>
                            </div>
                        </div>

                    @endif
                @endauth
                

                <!-- 5TO BOTÓN ACORDIÓN - CAMBIAR CELULAR-->
                @auth
                    @if (auth()->user()->rol == 'R' || auth()->user()->rol == 'G')
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                Cambiar Número de Celular
                            </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                            <div class="accordion-body"><br/>
                                


                                <strong>This is the first item's accordion body.</strong> Se cuerda cambiar tu nombre de usaurio caada 2 dias<code>.accordion-body</code>, though the transition does limit overflow.
                                <br/><br/>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="validationDefault03" class="form-label">Celular Actual</label>
                                        <input type="text" class="form-control" id="validationDefault03" value="{{ Persona::getCelular(auth()->user()->email) }}" disabled>
                                    </div>
                                </div>
                                <form class="row g-3" method="get" action="{{ route('editar-celular', auth()->user()->email) }}">
                                    
                                    <div class="col-md-6">
                                    <label for="validationDefault012" class="form-label">Nuevo Celular</label>
                                    <input type="text" class="form-control" id="validationDefault012" name="celular" required>
                                    </div>
                                    
                                    <div class="col-12"><button class="btn btn-primary" type="submit">Aplicar Cambios</button></div>

                                </form>

                                <br/>
                                <strong>Recomendación. </strong> Tu nombre de usuarios debe indicarse como.... <code>.accordion-body</code>.



                                <br/><br/>
                            </div>
                            </div>
                        </div>
                    @endif
                @endauth


                <!-- 6TO BOTÓN ACORDIÓN - CAMBIAR LOCALIZACION -->
                @auth
                    @if (auth()->user()->rol == 'M' || auth()->user()->rol == 'G')
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                                Actualizar Ubicación
                            </button>
                            </h2>
                            <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse">
                            <div class="accordion-body"><br/>
                                
        
        
                                <strong>This is the first item's accordion body.</strong> Se cuerda cambiar tu nombre de usaurio caada 2 dias<code>.accordion-body</code>, though the transition does limit overflow.
                                <br/><br/>
        
                                <form class="row g-3" method="get" action="{{ route('editar-lotation', auth()->user()->email) }}">
                                    <div class="col-md-7">
                                        <label class="form-label">Pais</label>
                                        <select class="form-select" name="pais" required>
                                            <option disabled >Choose...</option>
                                            @php $lista = array(
                                                "Afganistán",
                                                "Albania",
                                                "Alemania",
                                                "Andorra",
                                                "Angola",
                                                "Antigua y Barbuda",
                                                "Arabia Saudita",
                                                "Argelia",
                                                "Argentina",
                                                "Armenia",
                                                "Australia",
                                                "Austria",
                                                "Azerbaiyán",
                                                "Bahamas",
                                                "Bahrein",
                                                "Bangladesh",
                                                "Barbados",
                                                "Belarús",
                                                "Bélgica",
                                                "Belice",
                                                "Benin",
                                                "Bhután",
                                                "Bolivia",
                                                "Bosnia y Herzegovina",
                                                "Botswana",
                                                "Brasil",
                                                "Brunei Darussalam",
                                                "Bulgaria",
                                                "Burkina Faso",
                                                "Burundi",
                                                "Cabo Verde",
                                                "Camboya",
                                                "Camerún",
                                                "Canadá",
                                                "Chad",
                                                "Chequia",
                                                "Chile",
                                                "China",
                                                "Chipre",
                                                "Colombia",
                                                "Comoras",
                                                "Congo",
                                                "Costa Rica",
                                                "Côte D'Ivoire",
                                                "Croacia",
                                                "Cuba",
                                                "Dinamarca",
                                                "Djibouti",
                                                "Dominica",
                                                "Ecuador",
                                                "Egipto",
                                                "El Salvador",
                                                "Emiratos Árabes Unidos",
                                                "Eritrea",
                                                "Eslovaquia",
                                                "Eslovenia",
                                                "España",
                                                "Estados Unidos de América",
                                                "Estonia",
                                                "Eswatini",
                                                "Etiopía",
                                                "Federación de Rusia",
                                                "Fiji",
                                                "Filipinas",
                                                "Finlandia",
                                                "Francia",
                                                "Gabón",
                                                "Gambia",
                                                "Georgia",
                                                "Ghana",
                                                "Granada",
                                                "Grecia",
                                                "Guatemala",
                                                "Guinea",
                                                "Guinea Bissau",
                                                "Guinea Ecuatorial",
                                                "Guyana",
                                                "Haití",
                                                "Honduras",
                                                "Hungría",
                                                "India",
                                                "Indonesia",
                                                "Irán",
                                                "Iraq",
                                                "Irlanda",
                                                "Islandia",
                                                "Islas Marshall",
                                                "Islas Salomón",
                                                "Israel",
                                                "Italia",
                                                "Jamaica",
                                                "Japón",
                                                "Jordania",
                                                "Kazajstán",
                                                "Kenya",
                                                "Kirguistán",
                                                "Kiribati",
                                                "Kuwait",
                                                "Lesotho",
                                                "Letonia",
                                                "Líbano",
                                                "Liberia",
                                                "Libia",
                                                "Liechtenstein",
                                                "Lituania",
                                                "Luxemburgo",
                                                "Macedonia del Norte",
                                                "Madagascar",
                                                "Malasia",
                                                "Malawi",
                                                "Maldivas",
                                                "Malí",
                                                "Malta",
                                                "Marruecos",
                                                "Mauricio",
                                                "Mauritania",
                                                "México",
                                                "Micronesia",
                                                "Mónaco",
                                                "Mongolia",
                                                "Montenegro",
                                                "Mozambique",
                                                "Myanmar",
                                                "Namibia",
                                                "Nauru",
                                                "Nepal",
                                                "Nicaragua",
                                                "Niger",
                                                "Nigeria",
                                                "Noruega",
                                                "Nueva Zelandia",
                                                "Omán",
                                                "Paises",
                                                "Países Bajos",
                                                "Pakistán",
                                                "Palau",
                                                "Panamá",
                                                "Papúa Nueva Guinea",
                                                "Paraguay",
                                                "Perú",
                                                "Polonia",
                                                "Portugal",
                                                "Qatar",
                                                "Reino Unido",
                                                "República Árabe Siria",
                                                "República Centroafricana",
                                                "República de Corea",
                                                "República de Moldova",
                                                "República Democrática del Congo",
                                                "República Democrática Popular Lao",
                                                "República Dominicana",
                                                "Corea del Norte",
                                                "República Unida de Tanzanía",
                                                "Rumania",
                                                "Rwanda",
                                                "Saint Kitts y Nevis",
                                                "Samoa",
                                                "San Marino",
                                                "San Vicente y las Granadinas",
                                                "Santa Lucía",
                                                "Santo Tomé y Príncipe",
                                                "Senegal",
                                                "Serbia",
                                                "Seychelles",
                                                "Sierra Leona",
                                                "Singapur",
                                                "Somalia",
                                                "Sri Lanka",
                                                "Sudáfrica",
                                                "Sudán",
                                                "Sudán del Sur",
                                                "Suecia",
                                                "Suiza",
                                                "Suriname",
                                                "Tailandia",
                                                "Tayikistán",
                                                "Timor-Leste",
                                                "Togo",
                                                "Tonga",
                                                "Trinidad y Tabago",
                                                "Túnez",
                                                "Türkiye",
                                                "Turkmenistán",
                                                "Tuvalu",
                                                "Ucrania",
                                                "Uganda",
                                                "Uruguay",
                                                "Uzbekistán",
                                                "Vanuatu",
                                                "Venezuela",
                                                "Viet Nam",
                                                "Yemen",
                                                "Zambia",
                                                "Zimbabwe")
                                            @endphp
                                            @foreach ($lista as $pais)
                                                <option value="{{ $pais }}" @if ($pais == Hotel::getPais(auth()->user()->email) ) selected @endif>{{ $pais }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-8">
                                      <label for="validationDefault03" class="form-label">Ciudad</label>
                                      <input type="text" class="form-control" id="validationDefault03" name="ciudad" value="{{ Hotel::getCiudad(auth()->user()->email) }}" required>
                                    </div>
                                    
                                    <div class="col-md-8">
                                      <label for="validationDefault05" class="form-label">Dirección</label>
                                      <input type="text" class="form-control" id="validationDefault05" name="direccion" value="{{ Hotel::getDireccion(auth()->user()->email) }}" required>
                                    </div>
                                    <div class="col-12">
                                      <button class="btn btn-primary" type="submit">Submit form</button>
                                    </div>
                                  </form>
        
                                  <br/>
                                  <strong>Recomendación. </strong> Tu nombre de usuarios debe indicarse como.... <code>.accordion-body</code>.
        
        
        
                                  <br/><br/>
                            </div>
                            </div>
                        </div> 
                    @endif
                @endauth


                <!-- 7MO BOTÓN ACORDIÓN - CAMBIAR DATOS ADICIONALES-->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
                        Adicionales
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                    </div>
                </div>
                <br/>

            </div>
        </div>




    </div>


    <!-- Ventanas flotantes -->

    

    <!-- por si acaso no funciona algo -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="sweetalert2/dist/weetalert2.all.min.js"></script>
    <script>
        function validateForm(event) {
            event.preventDefault();
            
            var password = document.getElementById("passwordInput").value;
            var confirmPassword = document.getElementById("confirmPasswordInput").value;
            var errorMessage = document.getElementById("errorMessage");
            
            if (password != confirmPassword) {
                errorMessage.textContent = "Las contraseñas no coinciden. Por favor, intente nuevamente.";
            } else {
                event.target.submit();
            }
            
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

