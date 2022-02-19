@if(count($menu) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Código</th>
                <th>Nombre</th>
                <th>Posición</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($menu AS $m)
                <tr>
                    <td>{{str_pad($m->idmenu,7,'0000000',STR_PAD_LEFT)}}</td>
                    <td>{{$m->nombre}}</td>
                    <td>{{$m->posicion}}</td>
                    <td>{!! $m->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button"  data-toggle="dropdown" data-boundary="viewport" >
                                Seleccione
                            </button>
                            <div class="dropdown-menu"  data-idmenu="{{$m->idmenu}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($m->estado)
                                    <button class="dropdown-item btnModalInhabilitar" type="button"><i class="fa fa-times"> Inhabilitar</i></button>
                                @else
                                    <button class="dropdown-item btnModalHabilitar" type="button"><i class="fa fa-check"> Habilitar</i></button>
                                @endif
                                <button class="dropdown-item btnModalEliminar" type="button"><i class="fa fa-trash"> Eliminar</i></button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <p>
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{$menu->currentPage()}}">
            Mostrando del registro {{$menu->firstItem()}} al {{$menu->lastItem()}} de un total de {{$menu->total()}} registros
        </p>

        <div>
            {{$menu->links()}}
        </div>

    </div>
@else
    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>
@endif

