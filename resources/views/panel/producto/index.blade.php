@extends('panel.template.gentella')
@section('cuerpo')
@include('panel.producto.crear')
@include('panel.producto.editar')
@include('panel.producto.habilitar')
@include('panel.producto.inhabilitar')
@include('panel.producto.eliminar')
@include('panel.producto.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Productos</p>
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
                                @include('panel.producto.listado')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="module">


        const URL_LISTADO      = "{{ route('producto.listar') }}";
        const URL_GUARDAR      = "{{ route('producto.store') }}";
        const URL_VER          = "{{ route('producto.show','show') }}";
        const URL_EDIT         = "{{ route('producto.edit','edit') }}";
        const URL_MODIFICAR    = "{{ route('producto.update','update') }}";
        const URL_HABILITAR    = "{{ route('producto.habilitar') }}";
        const URL_INHABILITAR  = "{{ route('producto.destroy','destroy') }}";
        const URL_ELIMINAR_FILE = "{{ route('producto.removeFile') }}";
        const URL_SORT_FILES   = "{{ route('producto.sortFiles') }}";
        const URL_ELIMINAR     = "";



        const modales = () => {

            $(document).on("click","#btnModalCrear", (e) => {
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();
                CKEDITOR.instances.contenido.setData('');

                // $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#frmCrear .selectpicker").selectpicker("render");
                $("#modalCrear").modal("show");


            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');
                $("#frmHabilitar input[name=idproducto]").val(idproducto);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');
                $("#frmInhabilitar input[name=idproducto]").val(idproducto);
                $("#modalInhabilitar").modal("show");
            });

            /*$(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');
                $("#frmEliminar input[name=idproducto]").val(idproducto);
                $("#modalEliminar").modal("show");
            });*/

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');

                cargando('Procesando...');

                axios(URL_EDIT,{ params: {idproducto : idproducto} })
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idproducto]").val(data.idproducto);


                    console.log(data.categoria)
                    const $idcategorias = data.categoria.map( (elem) => {
                        return elem.idcategoria_producto;
                    })


                    $("#idcategoria_productoEditar").selectpicker("val",$idcategorias);
                    $("#codigoEditar").val(data.codigo);
                    $("#nombreEditar").val(data.nombre);
                    $("#precioEditar").val(data.precio);
                    $("#stockEditar").val(data.stock);
                    if (data.destacado){
                        $("#destacadoEditar").attr('checked',true);
                    }
                    $("#descripcionEditar").val(data.descripcion);
                    CKEDITOR.instances.contenidoEditar.setData(data.contenido);

                    const imagenSetting = allFilesData(BASE_URL+"/panel/img/producto",data.imagenes)
                    $("#imagenEditar").fileinput('destroy').fileinput({
                        dropZoneTitle : 'Arrastre la imagen aquí',
                        initialPreview : imagenSetting.urls,
                        initialPreviewConfig : imagenSetting.settings,
                        fileActionSettings : { showRemove : true, showDrag: true },
                        // uploadUrl : "#",
                        // uploadExtraData : _ => {},
                        deleteUrl : URL_ELIMINAR_FILE,
                        deleteExtraData : {
                            _token : "{{ csrf_token() }}"
                        },
                    });




                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');


                cargando('Procesando...');
                axios(URL_VER,{ params: {idproducto : idproducto} })
                .then(response => {
                    const data = response.data;

                    stop();

                    $("#tituloShow").val(data.titulo);
                    $("#subtituloShow").val(data.subtitulo);
                    $("#contenidoShow").html(data.contenido);
                    $("#modelo_desdeShow").val(data.modelo_desde);
                    $("#modelo_hastaShow").val(data.modelo_hasta);
                    $("#caudal_desdeShow").val(data.caudal_desde);
                    $("#caudal_hastaShow").val(data.caudal_hasta);
                    $("#presion_desdeShow").val(data.presion_desde);
                    $("#presion_hastaShow").val(data.presion_hasta);



                    if(data.imagen){
                        const img = `<img src="${ data.imagenData.url[0] }" style ="width: 200px;" >`;
                        $("#imagenShow").html(img);
                    }

                    if(data.pdf){
                        const pdf = `<a href="${ data.pdfData.url[0] }" target="_blank">Ver PDF</a>`;
                        $("#pdfShow").html(pdf);
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

        /*const eliminar = () => {
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
        }*/

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
            sortFiles();

            CKEDITOR.replace('contenido',{ height : 200 });
            CKEDITOR.replace('contenidoEditar',{ height : 200 });

        });


    </script>
@endpush
