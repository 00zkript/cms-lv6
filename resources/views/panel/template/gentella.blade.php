<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="token" id="token" content="{{csrf_token() }}"> --}}
    <title>PROTTEC SAC | Administrador</title>


    <link rel="icon" href="{{ asset('panel/img/empresa/'.$empresaGeneral->favicon) }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('panel/img/empresa/'.$empresaGeneral->favicon) }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('panel/img/empresa/'.$empresaGeneral->favicon) }}" />

    <link href="{{ asset('panel/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('panel/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('panel/css/nprogress.css') }}" rel="stylesheet">

    <link href="{{ asset('panel/css/custom.min.css') }}?v=1.1.0" rel="stylesheet">

    <link href="{{ asset('panel/css/waitMe.min.css') }}" rel="stylesheet">

    <link  href="{{ asset('panel/pnotify/PNotifyBrightTheme.css') }}" rel="stylesheet">

    <link href="{{ asset('panel/fileinput/css/fileinput.min.css') }}" rel="stylesheet">

    <link  href="{{ asset('panel/fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet">

    <link  href="{{ asset('panel/css/bootstrap-select.min.css') }}" rel="stylesheet">

    {{-- <base href="{{ url("/") }}/"> --}}

    <style>
        [ui-pnotify].ui-pnotify.stack-bar-top {
            width: 100%;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #2a3f54;
            border-color: #2a3f54;
        }

        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color:#2a3f54;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
        @media (min-width: 992px) {
            .modal-xl {
                max-width: 100%;
                margin-left: 1%;
                margin-right: 1%;
            }
        }

        .hide{
            display:none;
        }

    </style>
    {{--  fileinput  --}}
    <style>

       .kv-file-content{

            background: black;
        }
    </style>
    {{--  fin fileinput  --}}

    @stack('css')

</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a target="_blank" href="{{url('/') }}" class="site_title"><i class="fa fa-bank"></i> <span>PROTTEC SAC</span></a>
                </div>
                <div class="clearfix"></div>

                <div class="profile clearfix">
                    <div class="profile_pic">
                        @if(empty(auth()->user()->foto))
                            <img src="{{ asset('panel/img/img.webp') }}" alt="..." class="img-circle profile_img">
                        @else
                            <img src="{{ asset('panel/img/usuario/'.auth()->user()->foto) }}" alt="..." class="img-circle profile_img">
                        @endif

                    </div>
                    <div class="profile_info">
                        <span>Bienvenido,</span>
                        <h2>{{auth()->user()->usuario}}</h2>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <br/>

                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li>
                                <a href="{{route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                            </li>

                            <li><a><i class="fa fa-bars"></i> Menu <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('menu.index') }}">Menu</a></li>
                                </ul>
                            </li>



                            <li><a><i class="fa fa-file-text"></i> Contenido <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li> <a href="{{ route('categoria-producto.index') }}">Categoria de productos</a> </li>
                                    <li> <a href="{{ route('producto.index') }}">Productos</a> </li>
                                    <li> <a href="{{ route('proyecto.index') }}">Proyectos</a> </li>
                                    <li> <a href="{{ route('servicio.index') }}">Servicios</a> </li>
                                    <li> <a href="{{ route('pagina.index') }}">Paginas</a> </li>
                                </ul>
                            </li>


                            <li><a><i class="fa fa-tasks"></i> General <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ route('empresa.index') }}">Empresa</a></li>
                                    <li><a href="{{ route('nosotros.index') }}">Nosotros</a></li>
                                    <li><a href="{{ route('contacto.index') }}">Contactenos</a></li>
                                </ul>
                            </li>


                        </ul>
                    </div>

                </div>


                <div class="sidebar-footer hidden-small">

                    <a class="w-100" data-toggle="tooltip" data-placement="top" title="Cerrar sesión" href="{{route('login-panel.salir') }}">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>

            </div>
        </div>

        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                               id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                @if(empty(auth()->user()->foto))
                                    <img src="{{ asset('panel/img/img.webp') }}" alt="">{{auth()->user()->usuario}}
                                @else
                                    <img src="{{ asset('panel/img/usuario/'.auth()->user()->foto) }}" alt="">{{auth()->user()->usuario}}
                                @endif

                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('configuracion.edit') }}"><i class="fa fa-cogs pull-right"></i> Configuración</a>
                                <a class="dropdown-item" href="{{route('login-panel.salir') }}"><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a>
                            </div>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>


        <div class="right_col" role="main">
            @yield('cuerpo')
        </div>


        <footer>
            <div class="pull-right">
                PROTTEC SAC - CMS Admin by <a target="_blank" href="https://dezain.com.pe/">Dezain Estudio</a>
            </div>
            <div class="clearfix"></div>
        </footer>

    </div>
</div>

<script src="{{ asset('panel/js/jquery.min.js') }}"></script>

<script src="{{ asset('panel/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('panel/js/fastclick.js') }}"></script>

<script src="{{ asset('panel/js/nprogress.js') }}"></script>

<script src="{{ asset('panel/js/custom.min.js') }}"></script>

<script src="{{ asset('panel/pnotify/PNotify.js') }}"></script>

<script src="{{ asset('panel/pnotify/PNotifyButtons.js') }}"></script>

<script src="{{ asset('panel/fileinput/js/fileinput.min.js') }}"></script>

<script src="{{ asset('panel/fileinput/js/plugins/sortable.min.js') }}"></script>

<script src="{{ asset('panel/fileinput/js/locales/es.js') }}"></script>

<script src="{{ asset('panel/fileinput/themes/explorer-fa/theme.min.js') }}"></script>

<script src="{{ asset('panel/fileinput/themes/fa/theme.min.js') }}"></script>

<script src="{{ asset('panel/js/bootstrap-select.min.js') }}"></script>

<script src="{{ asset('panel/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('generales/js/axios.min.js') }}"></script>
<script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}' ;
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
</script>
<script src="{{ asset('generales/js/funciones.js') }}"></script>
<script src="{{ asset('generales/js/jquery.mask.js') }}"></script>
<script src="{{ asset('generales/js/ConfigFileInput.js') }}"></script>
<script src="{{ asset('generales/js/waitMe.min.js') }}"></script>


@include('ckfinder::setup')




<script>
    CKEDITOR.config.language = 'es';
    CKEDITOR.config.uiColor  = '#4C82ED';
    CKEDITOR.config.filebrowserBrowseUrl = "{{ route('ckfinder_browser') }}";
    CKEDITOR.config.filebrowserUploadUrl =  "{{ route('ckfinder_connector') }}";
    CKEDITOR.config.autoParagraph = false;
    CKEDITOR.config.enterMode  = 1;
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.extraPlugins ='html5video,widget,widgetselection,clipboard,lineutils';
    // CKEDITOR.config.contentsCss   = [
    //     "{{ asset("web/css/style.css") }}",
    //     "{{ asset("web/css/style-paginas.css") }}",
    //     "{{ asset("web/css/app.css") }}",
    //     "{{ asset("web/bootstrap/css/bootstrap.min.css") }}",
    //     "{{ asset("web/bootstrap/css/bootstrap-theme.min.css") }}"
    // ];


    CKFinder.setupCKEditor();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        }
    });

    $(function () {
        $("div .modal").removeAttr("tabindex");
    });

</script>

@stack('js')

</body>
</html>
