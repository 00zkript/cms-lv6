@extends('panel.template.gentella')
@section('cuerpo')
@include('panel.proyecto.crear')
@include('panel.proyecto.editar')
@include('panel.proyecto.habilitar')
@include('panel.proyecto.inhabilitar')
@include('panel.proyecto.eliminar')
@include('panel.proyecto.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Proyectos</p>
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
                                @include('panel.proyecto.listado')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="module" >


        const URL_LISTADO     = "{{ route('proyecto.listar') }}";
        const URL_GUARDAR     = "{{ route('proyecto.store') }}";
        const URL_VER         = "{{ route('proyecto.show','show') }}";
        const URL_EDIT        = "{{ route('proyecto.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('proyecto.update','update') }}";
        const URL_HABILITAR   = "{{ route('proyecto.habilitar') }}";
        const URL_INHABILITAR = "{{ route('proyecto.destroy','destroy') }}";
        const URL_ELIMINAR    = "";
        const URL_FILE_REMOVE = "{{ route('proyecto.removeFile') }}";
        const URL_SORT_FILES  = "{{ route('proyecto.sortFiles') }}";



        const modales = () => {

            $(document).on("click","#btnModalCrear", (e) => {
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();
                CKEDITOR.instances.contenido.setData('');

                $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idproyecto = $(this).closest('div.dropdown-menu').data('idproyecto');
                $("#frmHabilitar input[name=idproyecto]").val(idproyecto);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idproyecto = $(this).closest('div.dropdown-menu').data('idproyecto');
                $("#frmInhabilitar input[name=idproyecto]").val(idproyecto);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idproyecto = $(this).closest('div.dropdown-menu').data('idproyecto');
                $("#frmEliminar input[name=idproyecto]").val(idproyecto);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idproyecto = $(this).closest('div.dropdown-menu').data('idproyecto');

                cargando('Procesando...');

                axios(URL_EDIT,{ params: {idproyecto : idproyecto} })
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idproyecto]").val(data.idproyecto);


                    $("#tituloEditar").val(data.titulo);
                    CKEDITOR.instances.contenidoEditar.setData(data.contenido);


                    $("#imagenEditar").fileinput('destroy').fileinput(configFileInput({
                        url_file_remove: URL_FILE_REMOVE,
                        file_icon_remove: true,
                        file_icon_drag:true,
                        data : data.imagenData,
                        extra : {
                            _token : "{{ csrf_token() }}",
                        }

                    }));





                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idproyecto = $(this).closest('div.dropdown-menu').data('idproyecto');


                cargando('Procesando...');
                axios(URL_VER,{ params: {idproyecto : idproyecto} })
                .then(response => {
                    const data = response.data;

                    stop();

                    $("#tituloShow").html(data.titulo);
                    $("#contenidoShow").html(data.contenido);



                    if(data.imagen){
                        const img = `<img src="${ data.imagenData.url[0] }" style ="width: 200px;" >`;
                        $("#imagenShow").html(img);
                    }


                    if (data.estado){
                        $("#estadoShow").html('<label class="badge badge-success">Habilitado</label>');
                    }else{
                        $("#estadoShow").html('<label class="badge badge-danger">Inhabilitado</label>');
                    }


                    $("#modalVer").modal("show");

                })
                .catch(errorCatch)


            });

        }


        const filtros = () => {


            $(document).on("click","a.page-link", function(e) {
                e.preventDefault();
                const url               = e.target.href;
                const paginaActual      = url.split("?pagina=")[1];
                const cantidadRegistros = $("#cantidadRegistros").val();

                listado(cantidadRegistros,paginaActual);
            } )



            $(document).on("change","#cantidadRegistros", function(e) {
                e.preventDefault();
                const paginaActual      = $("#paginaActual").val();
                const cantidadRegistros = e.target.val();

                listado(cantidadRegistros,paginaActual);

            } )



            $(document).on("submit","#frmBuscar", function(e) {
                e.preventDefault();
                const txtBuscar         = $("#txtBuscar").val();
                const cantidadRegistros = $("#cantidadRegistros").val();
                const paginaActual      = $("#paginaActual").val();

                listado(cantidadRegistros,1,txtBuscar);

            } )

        }

        const listado = async (cantidadRegistros = 10,paginaActual = 1,txtBuscar = "") => {
            cargando();

            let form = new FormData();
            form.append("cantidadRegistros",cantidadRegistros);
            form.append("paginaActual",paginaActual);
            form.append("txtBuscar",txtBuscar);

            try{
                const response = await axios.post(URL_LISTADO, form );
                const data = response.data;

                stop();
                document.querySelector("#listado").innerHTML = data;


            }catch(error){
                errorCatch(error);
            }


        }



        const guardar = () => {
            $(document).on("submit","#frmCrear",function(e){
                e.preventDefault();
                var form = new FormData($(this)[0]);
                form.append('contenido',CKEDITOR.instances.contenido.getData());
                cargando('Procesando...');

                axios.post(URL_GUARDAR,form)
                .then(response => {
                    const data = response.data;
                    stop();

                    $("#modalCrear").modal("hide");
                    notificacion("success","Registro exitoso",data.mensaje);
                    listado();

                })
                .catch(errorCatch)




            });
        }


        const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);
                form.append('contenidoEditar',CKEDITOR.instances.contenidoEditar.getData());
                cargando('Procesando...');

                axios.post(URL_MODIFICAR,form)
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#modalEditar").modal("hide");
                    notificacion("success","Modificación exitosa",data.mensaje);
                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                })
                .catch(errorCatch)


            });
        }

        const habilitar = () => {
            $(document).on( "submit" ,"#frmHabilitar", function(e){
                e.preventDefault();
                var form = new FormData($(this)[0]);
                cargando('Procesando...');

                axios.post(URL_HABILITAR,form)
                .then( response => {
                    const data = response.data;
                    stop();

                    $("#modalHabilitar").modal("hide");

                    notificacion("success","Habilitado",data.mensaje);

                    const cantidadRegistros = $("#cantidadRegistros").val();
                    const paginaActual      = $("#paginaActual").val();
                    listado(cantidadRegistros,paginaActual);

                })
                .catch( errorCatch )


            } )

        }

        const inhabilitar = () => {
            $(document).on( "submit","#frmInhabilitar" , function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Procesando...');

                axios.post(URL_INHABILITAR,form)
                .then( response => {
                    const data = response.data;
                    stop();
                    $("#modalInhabilitar").modal("hide");

                    notificacion("success","Inhabilitado",data.mensaje);

                    const cantidadRegistros = $("#cantidadRegistros").val();
                    const paginaActual      = $("#paginaActual").val();
                    listado(cantidadRegistros,paginaActual);

                } )
                .catch( errorCatch )

            } )
        }

        const eliminar = () => {
            $(document).on( "submit","#frmEliminar" , function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Procesando...');

                axios.post(URL_ELIMINAR,form)
                .then( response => {
                    const data = response.data;
                    stop();
                    $("#modalEliminar").modal("hide");

                    notificacion("success","Eliminado",data.mensaje);

                    const cantidadRegistros = $("#cantidadRegistros").val();
                    const paginaActual      = $("#paginaActual").val();
                    listado(cantidadRegistros,paginaActual);

                } )
                .catch( errorCatch )

            } )
        }


        const sortFiles = () => {
            $('#imagenEditar').on('filesorted', function(event, params) {
                // console.log('preview',params.previewId,'old',params.oldIndex,'new index',params.newIndex,'stack',params.stack);

                axios.post(URL_SORT_FILES,{stack : JSON.stringify(params.stack) })
                .then( response => {
                    console.log(response.data);
                })
                .catch( e => {
                    console.log(e)
                })





            });
        }


        $("#imagen").fileinput(configFileInput({ file_icon_remove: true }));
        $("#imagenEditar").fileinput(configFileInput({ file_icon_remove: true }));





        $(function () {
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            sortFiles();

            CKEDITOR.replace('contenido',{ height : 200 });
            CKEDITOR.replace('contenidoEditar',{ height : 200 });

        });


    </script>
@endpush
