@if(count($paginas) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Código</th>
                <th>Titulo</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($paginas AS $item)
                <tr>
                    <td>{{ str_pad($item->idpagina,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td>{{ $item->titulo }}</td>
                    <td>{!! $item->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" data-boundary="viewport" >
                                Seleccione
                            </button>
                            <div class="dropdown-menu" data-idpagina="{{$item->idpagina}}" data-slug="{{ $item->slug  }}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i>Ver</button>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($item->estado)
                                    <button class="dropdown-item btnModalInhabilitar" type="button"><i class="fa fa-times"> Inhabilitar</i></button>
                                @else
                                    <button class="dropdown-item btnModalHabilitar" type="button"><i class="fa fa-check"> Habilitar</i></button>
                                @endif
                                <button class="dropdown-item btnModalEliminar" type="button"><i class="fa fa-trash"></i> Eliminar</button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <p>
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{$paginas->currentPage()}}">
            Mostrando del registro {{$paginas->firstItem()}} al {{$paginas->lastItem()}} de un total de {{$paginas->total()}} registros
        </p>

        <div>
            {{$paginas->links()}}
        </div>

    </div>
@else
    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>
@endif

