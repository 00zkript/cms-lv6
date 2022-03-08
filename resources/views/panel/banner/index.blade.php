@extends('panel.template.index')
@section('cuerpo')
@include('panel.banner.crear')
@include('panel.banner.editar')
@include('panel.banner.habilitar')
@include('panel.banner.inhabilitar')
@include('panel.banner.eliminar')
@include('panel.banner.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar banners</p>
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
                                @include('panel.banner.listado')
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
            eliminar();
            limpiarFormularios();
            cantidadBanners();


            CKEDITOR.replace('contenido',{
                height : 200
            });

            CKEDITOR.replace('contenidoEditar',{
                height : 200
            });

        });

        const listado = () => {

            $(document).on("click","a.page-link",(e)=>{
                e.preventDefault();
                var url = e.target.href;
                var paginaActual = url.split("?pagina=")[1];
                var cantidadRegistros = $("#cantidadRegistros").val();
                var txtBuscar = $("#txtBuscar").val();

                ajaxListado(cantidadRegistros,paginaActual,txtBuscar);
            });

            $("#cantidadRegistros").on("change",(e)=>{
                e.preventDefault();
                var paginaActual = $("#paginaActual").val();
                var cantidadRegistros = e.target.value;
                var txtBuscar = $("#txtBuscar").val();

                ajaxListado(cantidadRegistros,paginaActual,txtBuscar);
            });

            $("#frmBuscar").on("submit",(e)=>{
                e.preventDefault();
                var txtBuscar = $("#txtBuscar").val();
                var cantidadRegistros = $("#cantidadRegistros").val();
                ajaxListado(cantidadRegistros,1);
            });

        }

        const ajaxListado = (cantidadRegistros = 10,paginaActual = 1) => {
            $.ajax({
                url:'{{ route('banner.listar') }}',
                method:'POST',
                dataType:'json',
                data: {
                    cantidadRegistros:cantidadRegistros,
                    paginaActual:paginaActual,
                    txtBuscar: $("#txtBuscar").val().trim(),
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

        const limpiarFormularios = () => {
            $("#frmCrear input,select").on("keyup change",(e)=>{
                e.preventDefault();
                $("#frmCrear span.error").remove();
            });
            $("#frmEditar input,select").on("keyup change",(e)=>{
                e.preventDefault();
                $("#frmEditar span.error").remove();
            });
        }

        const modales = () => {

            $("#btnModalCrear").on("click",(e)=>{
                e.preventDefault();
                $("#frmCrear span.error").remove();
                CKEDITOR.instances.contenido.setData('');
                $("#frmCrear")[0].reset();
                $("#orden").html('');
                $("#modalCrear").modal("show");

            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');
                $("#frmHabilitar input[name=idbanner]").val(idbanner);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');
                $("#frmInhabilitar input[name=idbanner]").val(idbanner);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');
                $("#frmEliminar input[name=idbanner]").val(idbanner);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');
                $.ajax({
                    url:'{{ route('banner.edit','edit') }}',
                    method:'GET',
                    dataType:'json',
                    data: {
                        idbanner:idbanner
                    },
                    beforeSend:function () {
                        cargando('Procesando...')
                    },
                    success:function (response) {

                        let banner = response.data;

                        $("#frmEditar")[0].reset();
                        $("#frmEditar span.error").remove();
                        $("#idbanner").val(banner.idbanner);
                        $("#paginaEditar").val(banner.pagina);
                        cantidadBannersEditar(banner.orden,banner.pagina);
                        $("#imagenEditar").fileinput('destroy').fileinput({
                            theme: 'fa',
                            language: 'es',
                            //uploadUrl: "#",
                            uploadAsync:false,
                            uploadExtraData:false,
                            overwriteInitial: true,
                            dropZoneTitle:'Arrastre la fotografia aquí',
                            // dropZoneEnabled: false,
                            //maxImageWidth: 1200,
                            //maxImageHeight: 630,
                            deleteExtraData:function () {
                                return {
                                    idbanner:banner.idbanner
                                }
                            },
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
                            maxFileSize: 20000,
                            maxFileCount: 1,
                            autoReplace:true,
                            //minFileCount: 1,
                            initialPreview:[ !vacio(banner.imagen) ? '{{ asset('panel/img/banner/') }}/'+banner.imagen : '{{ asset('panel/img/vacio_img.jpg') }}'],
                            deleteUrl: "{{ route('banner.removerImagen') }}",
                            fileActionSettings: {
                                showRemove: false,
                                showUpload: false,
                                showZoom: false,
                                showDrag: false,
                            },
                        });

                        $("#videoEditar").val(banner.video);
                        CKEDITOR.instances.contenidoEditar.setData(banner.contenido);
                        $("#estadoEditar").val(banner.estado);

                        $("#modalEditar").modal("show");
                    },
                    error:function (data) {
                        if (data.status === 400){
                            notificacion('error','Error',data.responseJSON.data);
                        }else{
                            console.log(data);
                        }

                    },
                    complete:function () {
                        stop();
                    }
                });
            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');
                $.ajax({
                    url:'{{ route('banner.show','show') }}',
                    method:'GET',
                    dataType:'json',
                    data: {
                        idbanner:idbanner
                    },
                    beforeSend:function () {
                        cargando('Procesando...')
                    },
                    success:function (response) {

                        let banner = response.data;

                        $("#txtPagina").html(banner.pagina);



                        if (!vacio(banner.imagen)){
                            $("#txtImagen").attr('src','{{ asset('panel/img/banner/') }}/'+banner.imagen);
                        }else{
                            $("#txtImagen").attr('src','{{ asset('panel/img/vacio_img.jpg') }}');
                        }

                        $("#txtContenido").html(banner.contenido);



                        if (banner.estado){
                            $("#txtEstado").html('<label class="badge badge-success">Habilitado</label>');
                        }else{
                            $("#txtEstado").html('<label class="badge badge-danger">Inhabilitado</label>');
                        }


                        $("#modalVer").modal("show");
                    },
                    error:function (data) {
                        if (data.status === 400){
                            notificacion('error','Error',data.responseJSON.data);
                        }else{
                            console.log(data);
                        }
                    },
                    complete:function () {
                        stop();
                    }
                });
            });

        }

        const guardar = () => {
            $("#frmCrear").on("submit",(e)=>{
                e.preventDefault();

                   var form = new FormData($("#frmCrear")[0]);
                   form.append('contenido',CKEDITOR.instances.contenido.getData());

                $.ajax({
                    url:'{{ route('banner.store') }}',
                    method:'POST',
                    dataType:'json',
                    data:form ,
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        $("#frmCrear span.error").remove();
                        cargando('Procesando...');
                    },
                    success:function (response) {
                        $("#modalCrear").modal("hide");
                        notificacion("success","En hora buena",response.data);
                        ajaxListado();
                    },
                    error:function (data) {

                        if (data.status === 422){
                            var errores = data.responseJSON.errors;
                            var mensaje = '';
                            $.each(errores,(posicion,valor)=>{
                                mensaje += valor[0]+'\n';
                                $("#"+posicion).closest('div.form-group').append('<span class="text-danger error">'+valor[0]+'</span>');
                            });


                            notificacion("error","Error",mensaje);
                        }else{
                            console.log(data);
                        }



                    },
                    complete:function () {
                        stop();
                    }
                })
            });
        }


        const modificar = () => {
            $("#frmEditar").on("submit",(e)=>{
                e.preventDefault();

                var form = new FormData($("#frmEditar")[0]);
                form.append('contenidoEditar',CKEDITOR.instances.contenidoEditar.getData());

                $.ajax({
                    url:'{{ route('banner.update','update') }}',
                    method:'POST',
                    dataType:'json',
                    data: form,
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        $("#frmEditar span.error").remove();
                        cargando('Procesando...');
                    },
                    success:function (response) {
                        $("#modalEditar").modal("hide");
                        notificacion("success","En hora buena",response.data);
                        ajaxListado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    },
                    error:function (data) {

                        if (data.status === 422){
                            var errores = data.responseJSON.errors;
                            var mensaje = '';
                            $.each(errores,(posicion,valor)=>{
                                mensaje += valor[0]+'\n';
                                $("#"+posicion).closest('div.form-group').append('<span class="text-danger error">'+valor[0]+'</span>');
                            });

                            notificacion("error","Error",mensaje);
                        }else if(data.status === 400){
                            notificacion("error","Error",data.responseJSON.data);
                        }else{
                            console.log(data);
                        }



                    },
                    complete:function () {
                        stop();
                    }
                })
            });
        }


        const eliminar = () => {
            $("#frmEliminar").on("submit",(e)=>{
                e.preventDefault();
                $.ajax({
                    url:'{{ route('banner.destroy','destroy') }}',
                    method:'POST',
                    dataType:'json',
                    data: new FormData($("#frmEliminar")[0]),
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        cargando('Procesando...');
                    },
                    success:function (response) {
                        $("#modalEliminar").modal("hide");
                        notificacion("success","Eliminado",response.data);
                        ajaxListado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    },
                    error:function (data) {
                        if(data.status === 400){
                            notificacion("error","Error",data.responseJSON.data);
                        }else{
                            console.log(data);
                        }
                    },
                    complete:function () {
                        stop();
                    }
                })
            });
        }


        const habilitar = () => {
            $("#frmHabilitar").on("submit",(e)=>{
                e.preventDefault();
                $.ajax({
                    url:'{{ route('banner.habilitar') }}',
                    method:'POST',
                    dataType:'json',
                    data: new FormData($("#frmHabilitar")[0]),
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        cargando('Procesando...');
                    },
                    success:function (response) {
                        $("#modalHabilitar").modal("hide");
                        notificacion("success","Habilitado",response.data);
                        ajaxListado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    },
                    error:function (data) {
                        if(data.status === 400){
                            notificacion("error","Error",data.responseJSON.data);
                        }else{
                            console.log(data);
                        }
                    },
                    complete:function () {
                        stop();
                    }
                })
            });
        }

        const inhabilitar = () => {
            $("#frmInhabilitar").on("submit",(e)=>{
                e.preventDefault();
                $.ajax({
                    url:'{{ route('banner.inhabilitar') }}',
                    method:'POST',
                    dataType:'json',
                    data: new FormData($("#frmInhabilitar")[0]),
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        cargando('Procesando...');
                    },
                    success:function (response) {
                        $("#modalInhabilitar").modal("hide");
                        notificacion("success","Inhabilitado",response.data);
                        ajaxListado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    },
                    error:function (data) {
                        if(data.status === 400){
                            notificacion("error","Error",data.responseJSON.data);
                        }else{
                            console.log(data);
                        }
                    },
                    complete:function () {
                        stop();
                    }
                })
            });
        }


        var cantidadBanners = () => {
                $("#pagina").on("change",function (e) {
                    e.preventDefault();
                    $.ajax({
                        url:'{{ route('banner.cantidadBanners') }}',
                        method:'POST',
                        dataType:'json',
                        data:{
                          pagina:$(this).val()
                        },
                        beforeSend:function () {
                            $("#orden").html('');
                        },
                        success:function (response) {
                            for (var i=1;i<=response;i++){
                                $("#orden").append(
                                    '<option '+(i===response ? 'selected' : '')+' value="'+i+'">'+i+'</option>'
                                );
                            }
                        },
                        error:function (data) {
                            console.log(data);
                        },
                        complete:function () {

                        }
                    })
                })
        }


        var cantidadBannersEditar = (ordenActual,pagina) => {
            $.ajax({
                url:'{{ route('banner.cantidadBanners') }}',
                method:'POST',
                dataType:'json',
                data:{
                    pagina:pagina
                },
                beforeSend:function () {
                    $("#ordenEditar").html('');
                },
                success:function (response) {
                    for (var i=1;i<=response;i++){
                        $("#ordenEditar").append(
                            '<option '+(i===ordenActual ? 'selected' : '')+' value="'+i+'">'+i+'</option>'
                        );
                    }
                },
                error:function (data) {
                    console.log(data);
                },
                complete:function () {

                }
            })
        }




        $("#imagen").fileinput({
            theme: 'fa',
            language: 'es',
            //uploadUrl: "#",
            uploadAsync:false,
            uploadExtraData:false,
            overwriteInitial: true,
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
            maxFileSize: 20000,
            maxFileCount: 1,
            autoReplace: true,
            //minFileCount: 1,
            fileActionSettings: {
                showRemove: false,
                showUpload: false,
                showZoom: false,
                showDrag: false,
            },
        });



    </script>
@endpush
