
@foreach ($submenu as $h )

    @php( $rutaHijo =  $h->tipo_ruta == 'interna' ? route($h->ruta) : ($h->ruta ?: 'javascript::void(0)') )

    @if ( count($h->submenu) > 0 )

        <li class="dropdown{{ $k }} ">
            <a class="dropdown-item" href="#" data-bs-toggle="dropdown{{ $k }}" aria-expanded="false">
                {{ $h->nombre }}
                <span class="fas fa-caret-right"></span>
            </a>

            <ul class="submenu dropdown-menu">
                @include('web.template.submenu',[ "submenu" => $h->submenu, "k" => $k >= 3 ? 3 : $k+1])
            </ul>
        </li>
    @else
        <li class="{{ request()->url() ==  $rutaHijo ? 'active' : '' }}" ><a class="dropdown-item" href="{{ $rutaHijo }}">{{ $h->nombre }}</a></li>
    @endif

@endforeach
