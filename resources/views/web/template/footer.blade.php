<footer class="fondo-pie" style="background-image: url('{{ asset('web/img/fondo-footer1.jpg') }}');">
    <div class="container-mediano padding-arriba padding-abajo">
        <div class="row table-row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 tabla-col text-center-celu" style="vertical-align: top;">
                <h4 class="margen-arriba-sm">Síguenos</h4>
                <div class="redes" style="text-align: left;">
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
                </div>
            </div>

            <div class="co  l-lg-3 col-md-3 col-sm-3 col-xs-12 tabla-col text-center padd-right" style="vertical-align: top;">
                @if ($contactoGeneral->direccion)
                    <a href="javascript:void(0);"><span><img src="{{ asset('web/img/icono-direccion.png') }}"></span><div class="text-left">{{ $contactoGeneral->direccion }}</div></a>
                @endif
                <a href="javascript:void(0);"><span><img src="{{ asset('web/img/icono-celular.png') }}"></span><p>{{ $contactoGeneral->telefono.' / '.$contactoGeneral->telefono2.' / '.$contactoGeneral->telefono3 }}</p></a>


            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 tabla-col text-right text-left-celu" style="vertical-align: top;">
                <a href="mailto:{{ $contactoGeneral->correo }}"><span><img src="{{ asset('web/img/icono-email.png') }}"></span><p>Email: {{ $contactoGeneral->correo }}</p></a>
                <a href="{{ route('web.home') }}"><span><img src="{{ asset('web/img/icono-web.png') }}"></span><p>Web: {{ route('web.home') }}</p></a>
            </div>
        </div>
    </div>
</footer>
