<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Bienvenido a Larabrave')</title>

    <!-- Styles -->
        <!--Google Fonts-->
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|Oswald|Roboto|Playfair+Display" rel="stylesheet"> 

    <!--Usando CSS de Bootstrap con CDN-->
        <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"-->

    <!--Luego de instalar bootstrap con npm y webpack.mix-->
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    <!--ESte css debe estar registrado en mix-manifest.json para funcionar-->
    <!--Se resetea el mix con cada npm run-->
    <!--link rel="stylesheet" type="text/css" href="el mix con la ruta css/archivo.css"-->

    <style type="text/css">
        /*texto*/
            #main_title {
                font-weight: bold;
                font-family: 'IBM Plex Mono', monospace;
            }

            #main-phrase {
                font-family: 'Playfair Display', serif;
            }

            #name_link {
                color: green;
                font-family: 'Oswald', sans-serif;
            }
            #name_navbar {
                color: black;
                font-family: 'Playfair Display', serif;
            }
            #h-name {
                font-family: 'Playfair Display', serif;
            }
            .navbar {
                background-color: #ff9933;
            }

            .jumbotron{
                background-color: #ffeecc;
            }

            .card-text {
                font-family: 'IBM Plex Mono', monospace;
            }

            .text-muted {
                font-family: 'Oswald', sans-serif;
            }

            .navbar-brand {
                font-family: 'Oswald', sans-serif;
            }
            .nav-link {
                font-family: 'Oswald', sans-serif;
            }
            h5 {
                font-family: 'Playfair Display', serif;
            }
            input.name["message"] {
                font-family: 'Oswald', sans-serif;
            }

            /*Imagenes*/

            .imgRedonda {
                width: 60px;
                height: 60px;
                border-radius: 30px;
                border:5px solid #666;
            }
    </style>
    

</head>
<body>

    <div id="app" class="container-fluid">
        <nav class="navbar navbar-expand-md fixed-top navbar-light  mb-4 rounded">
           <div class="container">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Larabrave
                </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!--Tener cuidado: si el menu burguer no funciona puede ser el id-->
            <div class="collapse navbar-collapse" id="navbarCollapse">


                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    &nbsp;
                    
                    <li class="nav-item @if(Request::url() == url('/')) active @endif">
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li>

                    @guest
                        
                    @else
                        <li class="nav-item @if(Request::url() == url('/').'/'.Auth::user()->username) active @endif">
                            <a class="nav-link" href="/{{ Auth::user()->username }}">Mis publicaciones</a>
                        </li>
                    @endguest
                </ul>

                <!-- Right Side Of Navbar -->

                <!--Campo Search--> 
                <ul class="nav navbar-nav ml-auto">
                    <!--el name query se lleva al backend para hacer las busquedas al action-->
                    <form class="form-inline mt-2 mt-md-0 mr-2" action="/messages/search">
                      <input class="form-control mr-sm-2" type="text" placeholder="Un tema interesante" aria-label="Search" name="query" required>
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Entrar</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
                    @else
                        {{--Dropdown Notificaciones--}}
                        <li class=" nav-item dropdown mt-2 mr-2">
                            <a id="name_navbar" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            Notificaciones <span class="caret"></span>
                            </a>

                            {{--Componente Notifications de VueJS--}}
                            {{--No funciona si no esta dentro de un div con id=app--}}
                            <notifications :user="{{ Auth::user()->id }}"></notifications>
                            {{--Estamos pidiendo el user logueado para mandalo a las--}}
                            {{--props en el componente Notifications de vue--}}
                        </li>

                        {{--Dropdown Perfil--}}
                        <li class=" nav-item dropdown mt-2 mr-2">
                            <a id="name_navbar" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu">

                                    <a class="dropdown-item" href="/{{ Auth::user()->username }}">
                                        Perfil
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <!--form oculto que hara el submit de logout-->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>                             
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
           </div>
        </nav>

        <div class="container">
            <br><br><br><br>
            @yield('content')
        </div>

        <footer class="mt-4">
            <div class="py-3 text-center">
                <p class="text-muted">Larabrave. All Rights Reserved &copy;2018. ER Web Labz</p>
            </div>
        </footer>
     
    <!--div de container-->
    </div> 

    <!-- Scripts -->

    <!--JQUERY desde: http://code.jquery.com/-->
        <!--script
                  src="http://code.jquery.com/jquery-3.3.1.min.js"
                  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                  crossorigin="anonymous"></script-->
    <!--JS de Bootstrap-->
        <!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script-->

    <!--Luego de instalar webpack-mix y boostrap4 con npm-->
    <script src="{{ mix('js/app.js') }}"></script>
    
</body>
</html>
