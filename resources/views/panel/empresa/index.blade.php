@extends('panel.template.gentella')
@section('cuerpo')

    <div class="container-fluid">
        <form id="frmEditar">
            @csrf
            @method('PUT')
            <input type="hidden" name="idempresa" id="idempresa" value="{{ $empresa->idempresa}}">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #2a3f54">
                             <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Información de la empresa</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-refresh"></i> Modificar</button>
                                    <hr>
                                </div>

                                <div class="col-12">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active" id="criteriosBusqueda-tab" data-toggle="tab" href="#criteriosBusqueda" role="tab" aria-controls="criteriosBusqueda" aria-selected="true">Criterios de Búsqueda </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#seguimiento" role="tab" aria-controls="seguimiento" aria-selected="false">Seguimiento</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="imagenesGenerales-tab" data-toggle="tab" href="#imagenesGenerales" role="tab" aria-controls="imagenesGenerales" aria-selected="false">Imagenes Genrales</a>
                                        </li>

                                    </ul>
                                </div>



                                <div class="col-12">
                                    <div class="tab-content" id="myTabContent">

                                        <div class="tab-pane fade show active" id="criteriosBusqueda" role="tabpanel" aria-labelledby="criteriosBusqueda-tab">

                                            <div class="col-12">
                                                <br>

                                                <h2 class="font-weight-bold text-center">Criterios de Búsqueda :</h2>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="tituloGeneral">Titulo Pagina:</label>
                                                            <input type="text" name="tituloGeneral" id="tituloGeneral"  class="form-control" maxlength="300" placeholder="Titulo Pagina" value="{{ $empresa->titulo_general }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="keywords">Palabras clave:</label>
                                                            <input type="text" name="keywords" id="keywords"  class="form-control" maxlength="300" placeholder="Palabras clave" value="{{ $empresa->seo_keywords }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="author">Autor:</label>
                                                            <input type="text" name="author" id="author"  class="form-control" maxlength="50" placeholder="Autor" value="{{ $empresa->seo_author }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="description">Descripción:</label>
                                                            <textarea name="description" id="description" rows="5"  class="form-control" placeholder="Descripción"  >{{ $empresa->seo_description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="seguimiento" role="tabpanel" aria-labelledby="seguimiento-tab">

                                            <div class="col-12">
                                                <br>

                                                <h2 class="font-weight-bold text-center">Seguimiento:</h2>
                                                <hr>

                                                <div class="row">

                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="seguimientoHead">Head:</label>
                                                            <textarea name="seguimientoHead" id="seguimientoHead" rows="10" class="form-control" placeholder="Head"  >{{ $empresa->seguimiento_head }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="seguimientoBody">Body:</label>
                                                            <textarea name="seguimientoBody" id="seguimientoBody" rows="10" class="form-control" placeholder="Body"  >{{ $empresa->seguimiento_body }}</textarea>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="imagenesGenerales" role="tabpanel" aria-labelledby="imagenesGenerales-tab">

                                            <div class="col-12">
                                                <br>

                                                <h2 class="font-weight-bold text-center">Imagenes generales:</h2>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                                                        <div class="form-group">
                                                            <label for="favicon" >Favicon:</label>
                                                            <div class="file-loading">
                                                                <input  id="favicon" name="favicon" type="file" class="file" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                                                        <div class="form-group">
                                                            <label for="logo" >Logo:</label>
                                                            <div class="file-loading">
                                                                <input  id="logo" name="logo" type="file" class="file" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                                                        <div class="form-group">
                                                            <label for="logo2" >Logo #2:</label>
                                                            <div class="file-loading">
                                                                <input  id="logo2" name="logo2" type="file" class="file" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>











                                <hr>

                                </div>
                            </div>
                            <hr>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('js')

    <script  type="module">


        const URL_MODIFICAR = '{{ route('empresa.update','update') }}';



        const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Procesando...');

                axios.post(URL_MODIFICAR,form)
                .then(response => {
                    const data = response.data;

                    stop();
                    notificacion("success","Información modificada",data.mensaje);
                    location.reload();

                })
                .catch(errorCatch)


            });
        }






        $("#favicon").fileinput({
            dropZoneTitle         : 'Arrastre la imagen aquí',
            initialPreview       : [ "{{ asset("panel/img/empresa/".$empresa->favicon) }}" ],
            initialPreviewConfig : { caption : "{{ $empresa->favicon }}" , width : "120px", height : "120px" },
        });


        $("#logo").fileinput({
            dropZoneTitle         : 'Arrastre la imagen aquí',
            initialPreview       : [ "{{ asset("panel/img/empresa/".$empresa->logo) }}" ],
            initialPreviewConfig : { caption : "{{ $empresa->logo }}" , width : "120px", height : "120px" },
        });


        $("#logo2").fileinput({
            dropZoneTitle         : 'Arrastre la imagen aquí',
            initialPreview       : [ "{{ asset("panel/img/empresa/".$empresa->logo2) }}" ],
            initialPreviewConfig : { caption : "{{ $empresa->logo2 }}" , width : "120px", height : "120px" },
        });





        $(function () {
            modificar();

        });








    </script>
@endpush
