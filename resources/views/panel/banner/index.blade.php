@extends('panel.template.gentella')
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

        const URL_LISTADO     = "{{ route('banner.listar') }}";
        const URL_GUARDAR     = "{{ route('banner.store') }}";
        const URL_VER         = "{{ route('banner.show','show') }}";
        const URL_EDIT        = "{{ route('banner.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('banner.update','update') }}";
        const URL_HABILITAR   = "{{ route('banner.habilitar') }}";
        const URL_INHABILITAR = "{{ route('banner.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('banner.destroy','destroy') }}";
        const URL_ELIMINAR_IMAGEN = "{{ route('banner.removerImagen',) }}";
        const URL_POSICION     = "{{ route('banner.getPosicion',) }}";

        const modales = () => {

            $(document).on("click", "#btnModalCrear", function(e){
                e.preventDefault();
                $("#frmCrear")[0].reset();
                $("#frmCrear span.error").remove();
                CKEDITOR.instances.contenido.setData('');
                getPosicion();
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

                cargando('Procesando...')
                axios(URL_EDIT,{ params : { idbanner: idbanner } })
                .then( response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar span.error").remove();


                    $("#idbanner").val(data.idbanner);
                    $("#paginaEditar").val(data.pagina);
                    $("#rutaEditar").val(data.ruta);
                    CKEDITOR.instances.contenidoEditar.setData(data.contenido);
                    getPosicion("editar",data.posicion,data.pagina);

                    const imagen = !vacio(data.imagen)
                        ? BASE_URL+'/panel/img/banner/'+data.imagen
                        : BASE_URL+'/panel/img/vacio_img.jpg';

                    $("#imagenEditar").fileinput('destroy').fileinput({
                        dropZoneTitle: 'Arrastre la fotografia aquí',
                        initialPreview:[ imagen],
                        // deleteUrl: URL_ELIMINAR_IMAGEN,
                        // deleteExtraData: {
                            // idbanner: data.idbanner
                        // },
                    });

                    // $("#videoEditar").val(data.video);
                    $("#estadoEditar").val(data.estado);

                    $("#modalEditar").modal("show");

                })
                // .catch(errorCatch)



            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');

                cargando('Procesando...');
                axios(URL_VER,{ params: {idbanner : idbanner} })
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#paginaShow").html(data.pagina);
                    $("#contendioShow").html(data.contenido);
                    $("#rutaShow").html(data.ruta);
                    $("#posicionShow").html(data.posicion);


                    const imagen = !vacio(banner.imagen)
                        ? BASE_URL+'/panel/img/banner/'+data.imagen
                        : BASE_URL+'/panel/img/vacio_img.jpg';

                    $("#imagenShow").attr('src',imagen);




                    if (banner.estado){
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

            $(document).on("click", "a.page-link", function(e) {
                e.preventDefault();
                var url = e.target.href;
                var paginaActual = url.split("?pagina=")[1];
                var cantidadRegistros = $("#cantidadRegistros").val();
                var txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual);
            });

            $(document).on("change", "#cantidadRegistros", function(e) {
                e.preventDefault();
                var paginaActual = $("#paginaActual").val();
                var cantidadRegistros = e.target.value;
                var txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual);
            });

            $(document).on("submit", "#frmBuscar", function(e) {
                e.preventDefault();
                var txtBuscar = $("#txtBuscar").val();
                var cantidadRegistros = $("#cantidadRegistros").val();
                listado(cantidadRegistros,1);
            });

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


        const getPosicion = (accion , valorActual = null, pagina = null) => {


            let orderSelector = accion == "editar" ? "posicionEditar" : "posicion";


            $("#"+orderSelector+" option").remove();

            $("#"+orderSelector).append(`<option ${vacio(valorActual) ? 'selected' : '' } value="" hidden>[--- Seleccione ---]</option>`);
            axios.get(URL_POSICION,{
                params: {
                    pagina : pagina
                }
            })
            .then(response => {
                const data = response.data;

                for (let i = 1; i <= data.posicion_maxima ; i++) {
                    $("#"+orderSelector).append("<option "+ ( i == valorActual ? 'selected' : '') +" value="+i+">"+i+"</option>");
                };

                // $("#"+orderSelector).selectpicker("refresh");
            })
            .catch(e => console.log(e))





        }

        const changePariente = () => {
            document.querySelector('#pagina').addEventListener('change' ,function (e) {
                e.preventDefault();
                getPosicion('crear',null,this.value);
            })

            document.querySelector('#paginaEditar').addEventListener('change' ,function (e) {
                e.preventDefault();
                getPosicion('editar',null,this.value);
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


        $(function () {
            filtros();
            modales();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();

            changePariente();


            CKEDITOR.replace('contenido',{ height : 200 });
            CKEDITOR.replace('contenidoEditar',{ height : 200 });


        });



    </script>
@endpush
