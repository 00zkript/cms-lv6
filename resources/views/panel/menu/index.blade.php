@extends('panel.template.gentella')
@section('cuerpo')
@include('panel.menu.crear')
@include('panel.menu.editar')
@include('panel.menu.habilitar')
@include('panel.menu.inhabilitar')
@include('panel.menu.eliminar')
@include('panel.menu.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Menu</p>
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
                                @include('panel.menu.listado')
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

        const URL_LISTADO     = "{{ route('menu.listar') }}";
        const URL_GUARDAR     = "{{ route('menu.store') }}";
        const URL_EDIT        = "{{ route('menu.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('menu.update','update') }}";
        const URL_HABILITAR   = "{{ route('menu.habilitar') }}";
        const URL_INHABILITAR = "{{ route('menu.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('menu.destroy','destroy') }}";
        const URL_VER         = "{{ route('menu.show','show') }}";
        const URL_POSICION       = "{{ route('menu.getPosicion') }}";
        const URL_PARIENTES   = "{{ route('menu.getParientes') }}";


        const modales = () => {

            $(document).on("click","#btnModalCrear", (e) => {
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();
                HideTypeRouteOptions();
                getPosicion('crear');
                getParientes();
                $("#frmCrear .selectpicker").selectpicker("render");
                $("#modalCrear").modal("show");


            });



            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idmenu = $(this).closest('div.dropdown-menu').data('idmenu');
                $("#frmHabilitar input[name=idmenu]").val(idmenu);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idmenu = $(this).closest('div.dropdown-menu').data('idmenu');
                $("#frmInhabilitar input[name=idmenu]").val(idmenu);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idmenu = $(this).closest('div.dropdown-menu').data('idmenu');
                $("#frmEliminar input[name=idmenu]").val(idmenu);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idmenu = $(this).closest('div.dropdown-menu').data('idmenu');

                cargando('Procesando...');

                axios(URL_EDIT,{ params: {idmenu : idmenu} })
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();

                    $("#frmEditar input[name=idmenu]").val(data.idmenu);

                    getParientes("editar");
                    setTimeout(() => { $("#parienteEditar").selectpicker("val",data.pariente);}, 700);

                    $("#nombreEditar").val(data.nombre);
                    $("#tipoRutaEditar").val(data.idtipo_ruta);

                    HideTypeRouteOptions('editar');

                    if(data.idtipo_ruta == 2){
                        $('#rutaInternaEditar').selectpicker('val',data.ruta);
                        $('#rutaInternaEditar').closest('.tipoRutaDivEditar').show();
                    }

                    if(data.idtipo_ruta == 3){
                        $('#rutaExternaEditar').val(data.ruta);
                        $('#rutaExternaEditar').closest('.tipoRutaDivEditar').show();
                    }

                    getPosicion("editar",data.posicion,data.pariente);
                    $("#estadoEditar").val(data.estado);







                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idmenu = $(this).closest('div.dropdown-menu').data('idmenu');


                cargando('Procesando...');
                axios(URL_VER,{ params: {idmenu : idmenu} })
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#nombreShow").html(data.nombre);
                    $("#parienteShow").html(data.nombrePariente);
                    $("#posicionShow").html(data.posicion);
                    $("#tipoRutaShow").html(data.tipo_ruta);
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
                const cantidadRegistros = e.target.value;

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


        const getPosicion = ( accion , valorActual = null, pariente = null ) => {


            let orderSelector = accion == "editar" ? "posicionEditar" : "posicion";


            $("#"+orderSelector+" option").remove();

            $("#"+orderSelector).append(`<option ${ vacio(valorActual) ? 'selected' : '' }  value="" hidden >[--- Seleccione ---]</option>`);
            axios.get(URL_POSICION,{
                params: {
                    pariente : pariente
                }
            })
            .then(response => {
                const data = response.data;

                for (let i = 1; i <= data.posicion_maxima ; i++) {
                    $("#"+orderSelector).append("<option "+ ( i == valorActual ? 'selected' : '') +" data-tokens="+i+" value="+i+">"+i+"</option>");
                };

                $("#"+orderSelector).selectpicker("refresh");
            })
            .catch(e => console.log(e))





        }


        const getParientes = (accion) => {

            let parienteSelector = accion == "editar" ? "parienteEditar" : "pariente";

            $("#"+parienteSelector+" option").remove()
            axios(URL_PARIENTES)
            .then(response => {
                const data = response.data;

                $("#"+parienteSelector).append(`<option data-tokens='' value='' ${ accion != 'editar' ? 'selected' : '' } >Sin Parientes</option>`);
                data.forEach(ele => {
                    $("#"+parienteSelector).append(`<option data-tokens="${ ele.idmenu }" value="${ ele.idmenu }">${ ele.nombre }</option>`);

                });



                $("#"+parienteSelector).selectpicker("refresh");
            })
            .catch(e => console.log(e))


        }

        const changePariente = () => {
            document.querySelector('#pariente').addEventListener('change' ,function (e) {
                e.preventDefault();
                getPosicion('crear',null,this.value);
            })

            document.querySelector('#parienteEditar').addEventListener('change' ,function (e) {
                e.preventDefault();
                getPosicion('editar',null,this.value);
            })



        }

        const changeTypeRoute = () => {

            document.querySelector("#tipoRuta").addEventListener("change",function(){
                const rutaInterna = document.querySelector("#rutaInterna");
                const rutaExterna = document.querySelector("#rutaExterna");
                const rutaInternaCategoria = document.querySelector("#rutaInternaCategoria");

                HideTypeRouteOptions();

                if( this.value == 2 ){
                    rutaInterna.closest('.tipoRutaDiv').style.display = "";
                    rutaInterna.required = true;
                    return false;
                }

                if( this.value == 3 ){
                    rutaExterna.closest('.tipoRutaDiv').style.display = "";
                    rutaExterna.required = true;
                    return false;
                }


            })

            document.querySelector("#tipoRutaEditar").addEventListener("change",function(){
                const rutaInterna = document.querySelector("#rutaInternaEditar");
                const rutaExterna = document.querySelector("#rutaExternaEditar");
                const rutaInternaCategoria = document.querySelector("#rutaInternaCategoriaEditar");

                HideTypeRouteOptions('editar');

                if( this.value == 2 ){
                    rutaInterna.closest('.tipoRutaDivEditar').style.display = "";
                    rutaInterna.required = true;
                    return false;
                }

                if( this.value == 3 ){
                    rutaExterna.closest('.tipoRutaDivEditar').style.display = "";
                    rutaExterna.required = true;
                    return false;
                }

            })


        }

        const HideTypeRouteOptions = (accion) => {
            const elem = accion == 'editar' ? '.tipoRutaDivEditar' : '.tipoRutaDiv';

            document.querySelectorAll(elem).forEach( ele => {
                ele.style.display = 'none';

                if ( ele.querySelector('input') ) {
                    ele.querySelector('input').required = false;
                }

                if  ( ele.querySelector('select') ){
                    ele.querySelector('select').required = false;
                }

            })


        }







        $(function () {
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();

            changePariente();
            changeTypeRoute();
        });


    </script>
@endpush
