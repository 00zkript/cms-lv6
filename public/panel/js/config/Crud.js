class Crud{

    constructor(){
        this.url_ajaxListado  = (URL_AJAXLISTADO == null || URL_AJAXLISTADO == '') ? URL_AJAXLISTADO : '';
        this.url_guardar      = (URL_GUARDAR == null || URL_GUARDAR == '')         ? URL_GUARDAR     : '';
        this.url_edit         = (URL_EDIT == null || URL_EDIT == '')               ? URL_EDIT        : '';
        this.url_modificar    = (URL_MODIFICAR == null || URL_MODIFICAR == '')     ? URL_MODIFICAR   : '';
        this.url_habilitar    = (URL_HABILITAR == null || URL_HABILITAR == '')     ? URL_HABILITAR   : '';
        this.url_inhabilitar  = (URL_INHABILITAR == null || URL_INHABILITAR == '') ? URL_INHABILITAR : '';
        this.url_ver          = (URL_VER == null || URL_VER == '')                 ? URL_VER         : '';

    }


    listado = () => {

        const link = document.querySelector("a.page-link");
        if(link != null){

            link.addEventListener("click", e => {
                e.preventDefault();
                const url               = e.target.href;
                const paginaActual      = url.split("?pagina=")[1];
                const cantidadRegistros = document.querySelector("#cantidadRegistros").value;

                this.ajaxListado(cantidadRegistros,paginaActual);
            } )
        }

        const cantidadRegistros = document.querySelector("#cantidadRegistros");
        if(cantidadRegistros != null){

            cantidadRegistros.addEventListener("change", e => {
                e.preventDefault();
                const paginaActual      = document.querySelector("#paginaActual").value;
                const cantidadRegistros = e.target.value;

                this.ajaxListado(cantidadRegistros,paginaActual);

            } )
        }

        const frmBuscar = document.querySelector("#frmBuscar");
        if(frmBuscar != null){

            frmBuscar.addEventListener("submit", e => {
                e.preventDefault();
                const txtBuscar         = document.querySelector("#txtBuscar").value;
                const cantidadRegistros = document.querySelector("#cantidadRegistros").value;
                const paginaActual      = document.querySelector("#paginaActual").value;

                this.ajaxListado(cantidadRegistros,1,txtBuscar);

            } )
        }

    }

    ajaxListado = async (cantidadRegistros = 10,paginaActual = 1,txtBuscar = "") => {
        cargando();

        let form = new FormData();
        form.append("cantidadRegistros",cantidadRegistros);
        form.append("paginaActual",paginaActual);
        form.append("txtBuscar",txtBuscar);

        try{
            const response = await axios.post(this.url_ajaxListado, form );
            stop();
            if( [200,201].includes(response.status) ){
                const data = response.data;
                document.querySelector("#listado").innerHTML = data;
            }else{
                this.elseResponse(response);
            }

        }catch(error){
            this.errorCatch(error);
        }


    }

    ver = (params,success) => {

        cargando('Procesando...');

        axios({
            method : "get",
            url : this.url_ver,
            params : params
        })
        .then( this.response )
        .catch( this.errorCatch )
        .then(success);

    }

    guardar = async (form, success) => {
        try{
            document.querySelector("#frmCrear span.error").remove();
        }catch(e){

        }
        cargando('Procesando...');

        try{
            const response = await axios.post(this.url_guardar, form );
            stop();
            if( [200,201].includes(response.status) ){
                success(response.data);
            }else{
                this.elseResponse(response);
            }

        }catch(error){
            this.errorCatch(error);
        }


    }

    edit = (params, success)=>{

        cargando('Procesando...');

        axios({
            method : "get",
            url : this.url_edit,
            params: params
        })
        .then( this.response )
        .catch( this.errorCatch )
        .then( success );


    }

    modificar = async (form, success)=>{
        try{
            document.querySelector("#frmEditar span.error").remove();
        }catch(e){

        }
        cargando('Procesando...');

        try{
            const response = await axios.post(this.url_modificar, form );
            stop();
            if( [200,201].includes(response.status) ){
                success(response.data);
            }else{
                this.elseResponse(response);
            }

        }catch(error){

            this.errorCatch(error);
        }

    }

    habilitar = () => {
        const frmHabilitar = document.querySelector("#frmHabilitar");
        frmHabilitar.addEventListener( "submit" , (e) => {
            e.preventDefault();
            const form = new FormData(frmHabilitar);
            cargando('Procesando...');

            axios({
                method : "post",
                url : this.url_habilitar,
                data : form
            })
            .then( this.response )
            .catch( this.errorCatch )
            .then( data => {
                $("#modalHabilitar").modal("hide");

                notificacion("success","Habilitado",data);
                const cantidadRegistros = document.querySelector("#cantidadRegistros").value;
                const paginaActual      = document.querySelector("#paginaActual").value;
                this.ajaxListado(cantidadRegistros,paginaActual);
            } );

        } )

    }

    inhabilitar = () => {
        const frmInhabilitar = document.querySelector("#frmInhabilitar");
        frmInhabilitar.addEventListener( "submit" , (e) => {
            e.preventDefault();
            const form = new FormData(frmInhabilitar);
            cargando('Procesando...');
            axios({
                method : "post",
                url : this.url_inhabilitar,
                data : form
            })
            .then( this.response )
            .catch( this.errorCatch )
            .then( data => {
                $("#modalInhabilitar").modal("hide");

                notificacion("success","Inhabilitado",data);
                const cantidadRegistros = document.querySelector("#cantidadRegistros").value;
                const paginaActual      = document.querySelector("#paginaActual").value;
                this.ajaxListado(cantidadRegistros,paginaActual);
            });

        } )
    }

    response = ( response ) => {
        stop();
        if( [200,201].includes(response.status) ){
            return response.data;
        }

        notificacion('error','Error',"Hubo un error al obtener respuesta, intente nuevamente.");
        console.log(response)

    }

    elseResponse = ( response ) => {
        notificacion('error','Error',"Hubo un error al obtener respuesta, intente nuevamente.");
        console.log(response)
    }

}








