@extends('panel.template.gentella')
@section('cuerpo')
@include('panel.usuario.crear')
@include('panel.usuario.editar')
@include('panel.usuario.habilitar')
@include('panel.usuario.inhabilitar')
@include('panel.usuario.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar usuarios</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <button id="btnModalCrear" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo registro</button>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="cantidadRegistros">Cantidad de registros</label>
                                    <select name="cantidadRegistros" id="cantidadRegistros" class="form-control form-control-sm">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="9999999">Todos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <form id="frmBuscar">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" id="txtBuscar" name="txtBuscar" class="form-control" placeholder="Buscar...">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12" id="listado">
                                @include('panel.usuario.listado')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script !src="">
        $(function () {
            listado();
            modales();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            limpiarFormularios();
        });

        var listado = () => {

           $(document).on("click","a.page-link",(e)=>{
                e.preventDefault();
               var url = e.target.href;
               var paginaActual = url.split("?pagina=")[1];
               var cantidadRegistros = $("#cantidadRegistros").val();
               ajaxListado(cantidadRegistros,paginaActual);
            });

           $("#cantidadRegistros").on("change",(e)=>{
               e.preventDefault();
               var paginaActual = $("#paginaActual").val();
               var cantidadRegistros = e.target.value;
               ajaxListado(cantidadRegistros,paginaActual);
           });

           $("#frmBuscar").on("submit",(e)=>{
               e.preventDefault();
               var txtBuscar = $("#txtBuscar").val();
               var cantidadRegistros = $("#cantidadRegistros").val();
               ajaxListado(cantidadRegistros,1,txtBuscar);
           });

        }

        var ajaxListado = (cantidadRegistros = 10,paginaActual = 1,txtBuscar = null) => {
             $.ajax({
                    url:'{{route('usuarios.listar')}}',
                    method:'POST',
                    dataType:'json',
                    data: {
                        cantidadRegistros:cantidadRegistros,
                        paginaActual:paginaActual,
                        txtBuscar:txtBuscar,
                        _token:$("meta[name=token]").attr('content')
                    },
                    beforeSend:function () {
                        cargando();
                     },
                     success:function (data) {
                        $("#listado").html(data);
                     },
                     error:function (data) {
                     console.log(data);
                     },
                      complete:function () {
                        stop();
                      }
             })
        }

        var limpiarFormularios = () => {
            $("#frmCrear input,select").on("keyup change",(e)=>{
                e.preventDefault();
                $("#frmCrear span.error").remove();
            });
            $("#frmEditar input,select").on("keyup change",(e)=>{
                e.preventDefault();
                $("#frmEditar span.error").remove();
            });
        }

        var modales = () => {

            $("#btnModalCrear").on("click",(e)=>{
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();
                $("#modalCrear").modal("show");
            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idusuario = $(this).closest('div.dropdown-menu').data('idusuario');
                $("#frmHabilitar input[name=idusuario]").val(idusuario);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idusuario = $(this).closest('div.dropdown-menu').data('idusuario');
                $("#frmInhabilitar input[name=idusuario]").val(idusuario);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idusuario = $(this).closest('div.dropdown-menu').data('idusuario');
                 $.ajax({
                        url:'{{route('usuarios.edit','edit')}}',
                        method:'GET',
                        dataType:'json',
                        data: {
                            idusuario:idusuario
                        },
                        beforeSend:function () {
                            cargando('Procesando...')
                         },
                         success:function (data) {
                            $("#frmEditar")[0].reset();
                            $("#idusuario").val(data.idusuario);
                            $("#rolEditar").val(data.idrol);
                            $("#usuarioEditar").val(data.usuario);
                            $("#nombresEditar").val(data.nombres);
                            $("#apellidosEditar").val(data.apellidos);
                            $("#correoEditar").val(data.correo);

                            if (!vacio(data.foto)){
                                $("#fotoActual").attr('src','{{asset('panel/img/usuarios/')}}'+'/'+data.foto);
                            }else{
                                $("#fotoActual").attr('src','{{asset('panel/img/img.webp')}}');
                            }

                            $("#estadoEditar").val(data.estado);

                            $("#modalEditar").modal("show");
                         },
                         error:function (data) {
                         notificacion('error','Error',data.responseJSON);
                         },
                          complete:function () {
                            stop();
                          }
                 });
            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idusuario = $(this).closest('div.dropdown-menu').data('idusuario');
                $.ajax({
                    url:'{{route('usuarios.show','show')}}',
                    method:'GET',
                    dataType:'json',
                    data: {
                        idusuario:idusuario
                    },
                    beforeSend:function () {
                        cargando('Procesando...')
                    },
                    success:function (data) {

                        $("#txtRol").html(data.rol);
                        $("#txtUsuario").html(data.usuario);
                        $("#txtNombres").html(data.nombres);
                        $("#txtApellidos").html(data.apellidos);
                        $("#txtCorreo").html(data.correo);


                        if (!vacio(data.foto)){
                            $("#txtFoto").attr('src','{{asset('panel/img/usuarios/')}}'+'/'+data.foto);
                        }else{
                            $("#txtFoto").attr('src','{{asset('panel/img/img.webp')}}');
                        }

                        if (data.estado){
                            $("#txtEstado").html('<label class="badge badge-success">Habilitado</label>');
                        }else{
                            $("#txtEstado").html('<label class="badge badge-danger">Inhabilitado</label>');
                        }


                        $("#modalVer").modal("show");
                    },
                    error:function (data) {
                        notificacion('error','Error',data.responseJSON);
                    },
                    complete:function () {
                        stop();
                    }
                });
            });

        }

        var guardar = () => {
            $("#frmCrear").on("submit",(e)=>{
                e.preventDefault();
                 $.ajax({
                        url:'{{route('usuarios.store')}}',
                        method:'POST',
                        dataType:'json',
                        data: new FormData($("#frmCrear")[0]),
                        cache:false,
                        contentType:false,
                        processData:false,
                        beforeSend:function () {
                            $("#frmCrear span.error").remove();
                            cargando('Procesando...');
                         },
                         success:function (data) {
                             $("#modalCrear").modal("hide");
                             notificacion("success","Registro exitoso",data);
                             ajaxListado();
                         },
                         error:function (data) {
                            var errores = data.responseJSON.errors;
                            var mensaje = '';
                            $.each(errores,(posicion,valor)=>{
                                mensaje += valor[0]+'\n';
                                $("#"+posicion).closest('div.form-group').append('<span class="text-danger error">'+valor[0]+'</span>');
                            });


                             notificacion("error","Error",mensaje);


                         },
                          complete:function () {
                            stop();
                          }
                 })
            });
        }


        var modificar = () => {
            $("#frmEditar").on("submit",(e)=>{
                e.preventDefault();
                $.ajax({
                    url:'{{route('usuarios.update','update')}}',
                    method:'POST',
                    dataType:'json',
                    data: new FormData($("#frmEditar")[0]),
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        $("#frmEditar span.error").remove();
                        cargando('Procesando...');
                    },
                    success:function (data) {
                        $("#modalEditar").modal("hide");
                        notificacion("success","Modificación exitosa",data);
                        ajaxListado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    },
                    error:function (data) {
                        var errores = data.responseJSON.errors;
                        var mensaje = '';
                        $.each(errores,(posicion,valor)=>{
                            mensaje += valor[0]+'\n';
                            $("#"+posicion).closest('div.form-group').append('<span class="text-danger error">'+valor[0]+'</span>');
                        });


                        notificacion("error","Error",mensaje);


                    },
                    complete:function () {
                        stop();
                    }
                })
            });
        }


        var habilitar = () => {
            $("#frmHabilitar").on("submit",(e)=>{
                e.preventDefault();
                $.ajax({
                    url:'{{route('usuarios.habilitar')}}',
                    method:'POST',
                    dataType:'json',
                    data: new FormData($("#frmHabilitar")[0]),
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        cargando('Procesando...');
                    },
                    success:function (data) {
                        $("#modalHabilitar").modal("hide");
                        notificacion("success","Habilitado",data);
                        ajaxListado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    },
                    error:function (data) {
                        notificacion("error","Error",data.responseJSON);
                    },
                    complete:function () {
                        stop();
                    }
                })
            });
        }

        var inhabilitar = () => {
            $("#frmInhabilitar").on("submit",(e)=>{
                e.preventDefault();
                $.ajax({
                    url:'{{route('usuarios.destroy','destroy')}}',
                    method:'POST',
                    dataType:'json',
                    data: new FormData($("#frmInhabilitar")[0]),
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        cargando('Procesando...');
                    },
                    success:function (data) {
                        $("#modalInhabilitar").modal("hide");
                        notificacion("success","Inhabilitado",data);
                        ajaxListado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    },
                    error:function (data) {
                        notificacion("error","Error",data.responseJSON);
                    },
                    complete:function () {
                        stop();
                    }
                })
            });
        }



        $("#foto").fileinput({
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

    </script>
@endpush
