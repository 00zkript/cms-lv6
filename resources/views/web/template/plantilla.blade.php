<!DOCTYPE HTML >
<html lang="es" style="overflow-x: hidden;">
@php($v = time())
<head >
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('titulo') | {{ $empresaGeneral->titulo_general }} </title>
    <meta name="keywords" content="{{$empresaGeneral->seo_keywords}}"/>
    <meta name="description" content="{{$empresaGeneral->seo_description}}"/>
    <meta name="author" content="{{$empresaGeneral->seo_author}}">

    <meta name="distribution" content="global"/>
    <meta name="generator" content="Epsi. 1.0">
    <meta http-equiv="content-language" content="es">
    <meta name="language" content="Spanish">

    <!-- Cambiar color de navegador movil -->
    <meta name="theme-color" content="#1f1f1f" />
    <meta name="msapplication-navbutton-color" content="#1f1f1f"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>


    <link rel="icon" href="{{ asset('panel/img/empresa/'.$empresaGeneral->favicon) }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('panel/img/empresa/'.$empresaGeneral->favicon) }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('panel/img/empresa/'.$empresaGeneral->favicon) }}" />
    <meta name="msapplication-TileImage" content="{{ asset('panel/img/empresa/'.$empresaGeneral->favicon) }}" />

    <!-- Compartir redes sociales -->
    @yield('meta')
    <!-- Fin a compartir redes sociales -->

    {!! $empresaGeneral->seguimiento_head !!}




    @yield('css')

</head>
<body>

    {!! $empresaGeneral->seguimiento_body !!}

    <!-- MENU -->
        @include('web.template.menu')
    <!-- FIN MENU -->



    @yield('cuerpo')



    {{-- @include('web.template.suscribirse') --}}
    @include('web.template.footer')






    <link rel="stylesheet" href="{{ asset('generales/toast/toastr.min.css') }}">
    <script src="{{ asset('generales/toast/toastr.min.js') }}"></script>

    <script src="{{ asset('generales/js/jquery.mask.js') }}"></script>
    <script src="{{ asset('generales/js/funciones.js') }}"></script>
    <script src="{{ asset('generales/js/axios.min.js') }}"></script>
    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}' ;
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    </script>

    @stack('js')
</body>
</html>
