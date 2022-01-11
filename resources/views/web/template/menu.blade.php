<!-- MENU -->
<div class="menu header" id="menu">
    <div id="menu-container" class="container-mediano sin-padding-sm sin-margen-sm width-acho-sm">
      <div class="header_box">
        <div class="cont-cab">
          <div class="navbar-header">
            <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="div-logo">
            <a href="{{ route('web.home') }}"><img src="{{ asset('panel/img/empresa/'.$empresaGeneral->logo) }}" class="logo1"/><img src="{{ asset('panel/img/empresa/'.$empresaGeneral->logo) }}" class="logo2"></a>
          </div>
        </div>
        <nav class="navbar navbar-inverse" role="navigation">
          <div id="main-nav" class="collapse navbar-collapse navStyle">
            <ul  class="nav navbar-nav" id="mainNav">
                @foreach ($menuGeneral as $m )

                    <li id="{{ Str::slug($m->nombre) }}-0" class="{{ request()->url() == ( $m->tipo_ruta == 'interna' ? route($m->ruta) : $m->ruta) ? 'active' : '' }}">
                        <div class="link-menu">
                            <a href="{{ $m->tipo_ruta == 'interna' ? route($m->ruta) : $m->ruta }}" class="scroll-link separador-linea">{{ $m->nombre }}</a>
                        </div>
                    </li>
                @endforeach

            </ul>
          </div>
        </nav>
        <div class="bar-right hidden-sm hidden-xs">
          <ul class="nav navbar-right redes-menu">
            <!-- REDES SOCIALES -->
            @if ($contactoGeneral->facebook)
                <a href="{{ $contactoGeneral->facebook }}" target="_blank"><span class="icono-facebook"></span></a>
            @endif
            @if ($contactoGeneral->youtube)
                <a href="{{ $contactoGeneral->youtube }}" target="_blank"><span class="icono-youtube-logo"></span></a>
            @endif
            @if ($contactoGeneral->linkedin)
                <a href="{{ $contactoGeneral->linkedin }}" target="_blank"><span class="iconop-linkedin"></span></a>
            @endif
            @if ($contactoGeneral->twitter)
                <a href="{{ $contactoGeneral->twitter }}" target="_blank"><span class="icono-twitter"></span></a>
            @endif
            @if ($contactoGeneral->instagram)
                <a href="{{ $contactoGeneral->instagram }}" target="_blank"><span class="iconop-instagram"></span></a>
            @endif
            @if ($contactoGeneral->pinterest)
                <a href="{{ $contactoGeneral->pinterest }}" target="_blank"><span class="iconos-pinterest"></span></a>
            @endif
            @if ($contactoGeneral->whatsapp)
                <a href="https://api.whatsapp.com/send?phone=51{{ $contactoGeneral->whatsapp }}&text=Hola,%20deseo%20obtener%20m%C3%A1s%20informaci%C3%B3n." target="_blank"><span class="icono-whatsapp"></span></a>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN MENU -->
