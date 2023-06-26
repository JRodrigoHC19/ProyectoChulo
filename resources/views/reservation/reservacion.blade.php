<?php $opcion = ''; use Illuminate\Support\Str;?>

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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
            
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
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('hotel',auth()->user()->id)}}">Hotel</a>
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
        <div class=" container-fluid  align-items-start ">
            <div class="col-md-7 col-lg- mx-auto">
                
                <!-- CABEZERA DE PASOS -->
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" >Paso 1</button>
                    </li>

                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false" >Paso 2</button>
                    </li>

                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false" >Paso 3</button>
                    </li>
                </ul>

                <!-- CONTENIDO DE CADA PASO -->
                <div class="tab-content" id="myTabContent"> 
                   
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">   
                        <div class="col-md-11 col-lg- mx-auto"><br/>
                            
                            <strong>This is the first item's accordion body.</strong> Se cuerda cambiar tu nombre de usaurio caada 2 dias<code>.accordion-body</code>, though the transition does limit overflow.
                            <br/><br/>
                            <form class="row g-3" action="#" method="get">

                                <label class="form-label">Tipo de Habitación</label>

                                <div class="d-flex align-items-start border border-success rounded">
                                    
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Individual</button>
                                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Doble</button>
                                    <button class="nav-link" id="v-pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-disabled" type="button" role="tab" aria-controls="v-pills-disabled" aria-selected="false">Familiar</button>
                                    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Matrimonial</button>
                                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">King</button>
                                    </div>

                                    <div class="tab-content" id="v-pills-tabContent">
                                        
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0" >
                                            
                                            <div class="container-fluid overflow-auto" style="max-height: 15rem;">
                                                <div class="row">
                                                    
                                                    <div class="col-md-4 p-2">
                                                        <input type="radio" class="btn-check" name="options-outlined" id="hab-I-1" autocomplete="off">
                                                        <label class="container-fluid btn btn-outline-secondary" for="hab-I-1">
                                                            <p class="card-text">Habitación N° 1 <br/> Piso 1</p>
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="col-md-4 p-2">
                                                        <input type="radio" class="btn-check" name="options-outlined" id="hab-I-2" autocomplete="off">
                                                        <label class="container-fluid btn btn-outline-secondary" for="hab-I-2">
                                                            <p class="card-text">Habitación N° 2 <br/> Piso 1</p>
                                                        </label>
                                                    </div>

                                                    <div class="col-md-4 p-2">
                                                        <input type="radio" class="btn-check" name="options-outlined" id="hab-I-3" autocomplete="off">
                                                        <label class="container-fluid btn btn-outline-secondary" for="hab-I-3">
                                                            <p class="card-text">Habitación N° 3 <br/> Piso 2</p>
                                                        </label>
                                                    </div>

                                                    <div class="col-md-4 p-2">
                                                        <input type="radio" class="btn-check" name="options-outlined" id="hab-I-4" autocomplete="off">
                                                        <label class="container-fluid btn btn-outline-secondary" for="hab-I-4">
                                                            <p class="card-text">Habitación N° 4 <br/> Piso 1</p>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                                            
                                            <div class="container-fluid overflow-auto" style="max-height: 15rem;">
                                                <div class="row">
                                                    
                                                    <div class="col-md-4 p-2">
                                                        <input type="radio" class="btn-check" name="options-outlined" id="hab-D-1" autocomplete="off">
                                                        <label class="container-fluid btn btn-outline-secondary" for="hab-D-1">
                                                            <p class="card-text">Habitación N° 1 <br/> Piso 1</p>
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="col-md-4 p-2">
                                                        <input type="radio" class="btn-check" name="options-outlined" id="hab-D-2" autocomplete="off">
                                                        <label class="container-fluid btn btn-outline-secondary" for="hab-D-2">
                                                            <p class="card-text">Habitación N° 2 <br/> Piso 1</p>
                                                        </label>
                                                    </div>

                                                    <div class="col-md-4 p-2">
                                                        <input type="radio" class="btn-check" name="options-outlined" id="hab-D-3" autocomplete="off">
                                                        <label class="container-fluid btn btn-outline-secondary" for="hab-D-3">
                                                            <p class="card-text">Habitación N° 3 <br/> Piso 2</p>
                                                        </label>
                                                    </div>

                                                    <div class="col-md-4 p-2">
                                                        <input type="radio" class="btn-check" name="options-outlined" id="hab-D-4" autocomplete="off">
                                                        <label class="container-fluid btn btn-outline-secondary" for="hab-D-4">
                                                            <p class="card-text">Habitación N° 4 <br/> Piso 1</p>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">...</div>

                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">...</div>

                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">...</div>

                                    </div>

                                </div>
                                
                                <input type="text" value="{{$id}}" disabled />

                                <!-- INSERTAR UN CARRUSEL QUE MUESTRE LAS IMAGENES DE LAS AITACIONES SEGÚN EL TIPO DE HABITACIÓN -->

                                <div class="col-md-4">
                                    <label for="validationDefault05" class="form-label">Fecha de la Reservación</label>
                                    <input type="text" name="datefilter" />
                                </div>

                            </form><br/>


                            <strong>Recomendación. </strong> Tu nombre de usuarios debe indicarse como.... <code>.accordion-body</code><br/><br/>

                            <button type="button" id="paso2" class="btn btn-primary">Go somewhere</button>
                        </div>

                        <div class="col-md-11 col-lg- mx-auto">
                            <div>
                                <div><br/>

                                    
                                    
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0"><br/>
                        
                        <div class="card">
                            <div class="card-header">
                              <ul class="nav nav-pills card-header-pills justify-content-center">
                                <li class="nav-item ">
                                  <a class="nav-link disabled" href="#">Resumen de la Reservación</a>
                                </li>
                              </ul>
                            </div>
                            <div class="card-body">
                              <h5 class="card-title">Special title treatment</h5>
                              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                              <button id="paso3" class="btn btn-primary">Go somewhere</button>
                            </div>
                        </div>

                    </div>


                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0"><br/>
                        
                        <div class="d-flex justify-content-center">
                            <div class="card" style="width: 18rem;">
                                <img src="https://sistemasinteractivos.com/wp-content/uploads/2020/04/gracias-por-tu-compra.png" class="card-img-top" alt="imagen" />
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <button id="finalizar" class="btn btn-primary">Go somewhere</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>


    <!-- Ventanas flotantes -->
        <!-- NOS MUESTR UN MODAL - NOS PERMITE CONCRETAR EL PAGO -->
            <!-- Button trigger modal -->
            <button id="pago" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       +             </div>
                    
                    <div class="modal-body">

                    

                    <div class="container mt-5">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <h1>Formulario de Pago</h1>
                                    <form>
                                        <div class="mb-3">
                                            <label for="cardholder" class="form-label">Titular de la Tarjeta</label>
                                            <input type="text" class="form-control" id="cardholder" placeholder="Nombre del titular de la tarjeta" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cardnumber" class="form-label">Número de Tarjeta</label>
                                            <input type="text" class="form-control" id="cardnumber" placeholder="Número de tarjeta" required>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="expiration" class="form-label">Fecha de Expiración</label>
                                                    <input type="text" class="form-control" id="expiration" placeholder="MM/AA" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="cvv" class="form-label">CVV</label>
                                                    <input type="text" class="form-control" id="cvv" placeholder="CVV" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Monto a Pagar</label>
                                            <input type="text" class="form-control" id="amount" placeholder="Monto en dólares" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Pagar</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </div>
            </div>


    <!-- por si acaso no funciona algo -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        // CALENDARIO DE DOBLE FECHA
        $(function() {
            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {cancelLabel: 'Clear'},
                isInvalidDate: function(date) {
                    // Array de fechas bloqueadas
                    var blockedDates = [
                        '2023-06-25',
                        '2023-06-28',
                        '2023-06-30'
                    ];

                    // Verificar si la fecha está en el array de fechas bloqueadas
                    var formattedDate = date.format('YYYY-MM-DD');
                    return blockedDates.includes(formattedDate);
                }   
            });
            
            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });
            
            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });

        // OCUTAR UNA ETIQUETA, PERO SIN DESHABILITAR SU FUNCIONALIDAD
        document.getElementById('pago').style.display = 'none';

        // PRESIONA UN BOTÓN AL PRESIONAR OTRO BOTÓN
        document.getElementById('paso2').addEventListener('click', function() {
            document.getElementById('profile-tab').click();
        });  
        document.getElementById('paso3').addEventListener('click', function() {
            document.getElementById('pago').click();
            document.getElementById('contact-tab').click();
        });
        document.getElementById('finalizar').addEventListener('click', function() {
            document.getElementById('home-tab').click();
        });
    </script>

</body>
</html>

