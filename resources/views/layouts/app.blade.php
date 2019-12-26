<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/principal.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
          integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt"
          crossorigin="anonymous">
    <script>
        window.ciudadgeneral = 'Cartagena, Colombia';
        window.migoosevento = {!! json_encode(json_decode(session('event_ubicacion'),true)) !!};
    </script>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-color  navbar-inverse">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>
    <div>
        <a class="navbar-brand" href="{{url('/')}}">
            <img class="brand" src="{{asset('img/brand.png')}}" alt="Migoos plataforma de eventos">
            Migoos
        </a>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#!">Crear un Evento</a>
            </li>
 <li class="nav-item">
                <a class="nav-link" href="#!">Prueba</a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" id="ingresar" href="#" data-toggle="modal" data-target="#exampleModalCenter">
                        Iniciar </a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<body>
<div id="app">
@yield('content')

@include('layouts.footer')
<!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Iniciar Sesion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('social.auth', 'facebook') }}" type="button"
                               class="btn btn-primary btn-lg btn-block">
                                <i class=" fab fa-facebook"></i> &nbsp; Facebook
                            </a>
                            <a href="{{ route('social.auth', 'google') }}" type="button"
                               class="btn btn-danger  btn-lg btn-block">
                                <i class="fab fa-google"></i> &nbsp; Google +
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="orSeparator">
                                <h5 class="card-title">Ya tengo una cuenta</h5>
                            </div>
                            <form method="POST" action="{{ route('login') }}" class="form" role="form"
                                  autocomplete="off" id="formLogin" novalidate="" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-sm-12 col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-8 col-sm-12">
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                           class="col-md-4 col-sm-12 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-8 col-sm-12">
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-sm btn-block">
                                            {{ __('Login') }}
                                        </button>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        <a class="btn btn-link" href="{{ url('registrarme') }}">
                                            {{ __('Quiero registrarme') }}
                                        </a>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="card-footer">
                            <p class="text">
                                <strong>Disfrute de los beneficios de tener una cuenta.</strong>
                                ¡Reservas en línea, reservas, opciones personalizadas, herramientas de planificación
                                todo lo que necesita para planificar
                                su próxima aventura!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="v-spinner preloader-background">
    <div class="v-bounce v-bounce1" style="height: 60px; width: 60px; position: relative;">
        <div class="v-bounce v-bounce2"
             style="background-color: rgb(100, 221, 23); height: 60px; width: 60px; border-radius: 100%; opacity: 0.6; position: absolute; top: 0px; left: 0px;"></div>
        <div class="v-bounce v-bounce3"
             style="background-color: rgb(100, 221, 23); height: 60px; width: 60px; border-radius: 100%; opacity: 0.6; position: absolute; top: 0px; left: 0px;"></div>
    </div>
</div>
<!-- Scripts -->
<script src="{{asset('js/funcionesgenerales.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="{{mix('/js/manifest.js')}}"></script>
<script src="{{mix('/js/vendor.js')}}"></script>
<script src="{{mix('/js/app.js')}}"></script>
<script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    $(document).ready(function () {
        $(".v-spinner").hide();
    });
</script>
@yield('script')
@if($errors->any())
    <script>
        $(document).ready(function () {
            document.getElementById('ingresar').click();
        });
    </script>
@endif
</body>


</html>
