@extends('panel.template.gentella')
@section('cuerpo')

    <div class="container-fluid">
        <form id="frmEditar" autocomplete="off">
            @csrf
            @method('PUT')
            <input type="hidden" value="{{ $usuario->idusuario }}" name="idusuario">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                    <hr>
                </div>


                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="usuarioEditar">Usuario: <span class="text-danger">(*)</span></label>
                        <input type="text" name="usuarioEditar" id="usuarioEditar" required class="form-control" maxlength="50" placeholder="Usuario" value="{{ $usuario->usuario }}">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="claveEditar">Clave: </label>
                        <input type="password" name="claveEditar" id="claveEditar" class="form-control" maxlength="20" placeholder="********">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="nombresEditar">Nombres: <span class="text-danger">(*)</span></label>
                        <input type="text" name="nombresEditar" id="nombresEditar" required class="form-control" maxlength="50" placeholder="Nombres" value="{{ $usuario->nombres }}">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="apellidosEditar">Apellidos: <span class="text-danger">(*)</span></label>
                        <input type="text" name="apellidosEditar" id="apellidosEditar" required class="form-control" maxlength="50" placeholder="Apellidos" value="{{ $usuario->apellidos }}">
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="correoEditar">Correo: <span class="text-danger">(*)</span></label>
                        <input type="email" name="correoEditar" id="correoEditar" required class="form-control" maxlength="100" placeholder="Ejemplo@correo.com" value="{{ $usuario->email }}">
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    <p class="mb-0">Foto actual:</p>
                    <img style="width: 130px;height: 130px" class="img-thumbnail" src="{{ $usuario->foto ? asset('panel/img/usuario/'.$usuario->foto) :  asset('panel/img/img.webp')  }}" id="fotoActual">
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="fotoEditar" >Foto:</label>
                        <div class="file-loading">
                            <input  id="fotoEditar" name="fotoEditar" type="file" class="file" >
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>

@endsection
@push('js')

    <script >

        const URL_MODIFICAR = "{{ route('configuracion.update') }}";



        var modificar = () => {
            $("#frmEditar").on("submit",(e)=>{
                e.preventDefault();

                const form = new FormData(e.target);
                cargando('Procesando...');

                axios.post(URL_MODIFICAR,form)
                .then( response => {
                    const data = response.data;

                    stop();
                    $("#modalEditar").modal("hide");
                    notificacion("success","Información modificada",data.mensaje);
                    location.reload();
                })
                .catch(errorCatch)



            });
        }



        $("#fotoEditar").fileinput({
            theme: 'fa',
            language: 'es',
            //uploadUrl: "#",
            uploadAsync:false,
            uploadExtraData:false,
            overwriteInitial: false,
            dropZoneTitle:'Arrastre la fotografia aquí',
            // dropZoneEnabled: false,
            //maxImageWidth: 1200,
            //maxImageHeight: 630,
            showUpload:false,
            showDrag :false,
            // required:true,
            validateInitialCount: true,
            initialPreviewAsData: true,
            previewFileType: "image",
            showRemove: false,
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'png', 'jpeg'],
            removeFromPreviewOnError:true,
            maxFileSize: 10000,
            maxFileCount: 1,
            //minFileCount: 1,
            fileActionSettings: {
                showRemove: true,
                showUpload: false,
                showZoom: false,
                showDrag: false,
            },
        });



        $(document).ready(function(){
            modificar();
        })










    </script>
@endpush
