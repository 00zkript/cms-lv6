@if(count($banners) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Imagen</th>
                <th>Pagina</th>
                <th>Posición</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody class="text-nowrap">

            @foreach($banners AS $b)
                <tr>
                    <td class="text-center">
                        @php( $img = $b->imagen ? asset('panel/img/banner/'.$b->imagen) : asset('panel/img/vacio_img.jpg') )
                        <img class="img-thumbnail" style="width: 80px;height: 80px" src="{{ $img }}" alt="">
                    </td>
                    <td>{{ $b->pagina}}</td>
                    <td>{{ $b->posicion}}</td>
                    <td>{!! $b->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $b->idbanner}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $b->idbanner}}" data-idbanner="{{ $b->idbanner}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($b->estado)
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
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $banners->currentPage() }}">
            Mostrando del registro {{ $banners->firstItem() }} al {{ $banners->lastItem() }} de un total de {{ $banners->total() }} registros
        </p>

        <div>
            {{ $banners->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
