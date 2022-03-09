@extends('panel.template.gentella')
@section('cuerpo')

    <div class="container-fluid">
        <form id="frmEditar">
            @csrf
            @method('PUT')
            <input type="hidden" name="idnosotros" id="idnosotros" value="{{ $nosotros->idnosotros }}">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #2a3f54">
                             <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Información de Nosotros</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-refresh"></i> Modificar</button>
                                    <hr>
                                </div>


                                <div class="col-12">
                                    <br>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="mision">Misión:</label>
                                                <textarea id="mision" rows="5"  class="form-control" placeholder="Misión"  >{{ $nosotros->mision }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="vision">Visión:</label>
                                                <textarea id="vision" rows="5"  class="form-control" placeholder="Visión"  >{{ $nosotros->vision }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="somos">¿Quiénes somos?:</label>
                                                <textarea id="somos" rows="5"  class="form-control" placeholder="¿Quiénes somos?"  >{{ $nosotros->quienes_somos }}</textarea>
                                            </div>
                                        </div>


                                    </div>
                                </div>



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

        const URL_MODIFICAR = '{{route('nosotros.update','update')}}';



        const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);
                form.append('mision',CKEDITOR.instances.mision.getData());
                form.append('vision',CKEDITOR.instances.vision.getData());
                form.append('somos',CKEDITOR.instances.somos.getData());

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




        $(function () {
            modificar();

            CKEDITOR.replace('mision',{ height : 400});
            CKEDITOR.replace('vision',{ height : 400});
            CKEDITOR.replace('somos',{ height : 400});

        });








    </script>
@endpush
