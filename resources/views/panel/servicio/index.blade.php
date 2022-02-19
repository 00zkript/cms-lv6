@extends('panel.template.gentella')
@section('cuerpo')
@include('panel.servicio.crear')
@include('panel.servicio.editar')
@include('panel.servicio.habilitar')
@include('panel.servicio.inhabilitar')
@include('panel.servicio.eliminar')
@include('panel.servicio.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Registros</p>
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
                                @include('panel.servicio.listado')
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


        const URL_LISTADO     = "{{ route('servicio.listar') }}";
        const URL_GUARDAR     = "{{ route('servicio.store') }}";
        const URL_VER         = "{{ route('servicio.show','show') }}";
        const URL_EDIT        = "{{ route('servicio.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('servicio.update','update') }}";
        const URL_HABILITAR   = "{{ route('servicio.habilitar') }}";
        const URL_INHABILITAR   = "{{ route('servicio.habilitar') }}";
        const URL_ELIMINAR = "{{ route('servicio.destroy','destroy') }}";



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
                var idservicio = $(this).closest('div.dropdown-menu').data('idservicio');
                $("#frmHabilitar input[name=idservicio]").val(idservicio);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idservicio = $(this).closest('div.dropdown-menu').data('idservicio');
                $("#frmInhabilitar input[name=idservicio]").val(idservicio);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idservicio = $(this).closest('div.dropdown-menu').data('idservicio');
                $("#frmEliminar input[name=idservicio]").val(idservicio);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idservicio = $(this).closest('div.dropdown-menu').data('idservicio');

                cargando('Procesando...');

                axios(URL_EDIT,{ params: {idservicio : idservicio} })
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idservicio]").val(data.idservicio);


                    $("#nombreEditar").val(data.nombre);
                    CKEDITOR.instances.contenidoEditar.setData(data.contenido);


                    $("#imagenEditar").fileinput('destroy').fileinput({
                        dropZoneTitle : 'Arrastre la imagen aquí',
                        initialPreview : [ BASE_URL+"/panel/img/servicio/"+data.imagen ],
                        initialPreviewConfig : { caption : data.imagen , width: "120px", height : "120px" },
                        // fileActionSettings : { howRemove : false, showUpload : false, showZoom : true, showDrag : false},
                        // uploadUrl : "#",
                        // uploadExtraData : _ => {},
                        // deleteUrl : "#",
                        // deleteExtraData : _ => {},
                    });





                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idservicio = $(this).closest('div.dropdown-menu').data('idservicio');


                cargando('Procesando...');
                axios(URL_VER,{ params: {idservicio : idservicio} })
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

                listado(cantidadRegistros,1);

            } )

        }

        const listado = async (cantidadRegistros = 10,paginaActual = 1) => {
            cargando();

            const form = {
                cantidadRegistros : cantidadRegistros,
                paginaActual : paginaActual,
                txtBuscar : $("#txtBuscar").val().trim(),
            }

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

                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());

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

                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());

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

                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                } )
                .catch( errorCatch )

            } )
        }



        $("#imagen").fileinput({
            dropZoneTitle : 'Arrastre la imagen aquí'
        });

        $("#imagenEditar").fileinput({
            dropZoneTitle : 'Arrastre la imagen aquí'
        });





        $(function () {
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();

            CKEDITOR.replace('contenido',{ height : 200 });
            CKEDITOR.replace('contenidoEditar',{ height : 200 });

        });


    </script>
@endpush
