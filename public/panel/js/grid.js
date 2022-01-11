function GRID(url_ajaxListado, url_guardar, url_edit, url_modificar, url_habilitar, url_inhabilitar, url_ver = ''){
    this.url_ajaxListado  =url_ajaxListado
    this.url_guardar      =url_guardar
    this.url_edit         =url_edit
    this.url_modificar    =url_modificar
    this.url_habilitar    =url_habilitar
    this.url_inhabilitar  =url_inhabilitar
    this.url_ver          =url_ver


    this.listado = () => {

       $(document).on("click","a.page-link",(e)=>{
            e.preventDefault();
           var url = e.target.href;
           var paginaActual = url.split("?pagina=")[1];
           var cantidadRegistros = $("#cantidadRegistros").val();
           this.ajaxListado(cantidadRegistros,paginaActual);
        });

       $("#cantidadRegistros").on("change",(e)=>{
           e.preventDefault();
           var paginaActual = $("#paginaActual").val();
           var cantidadRegistros = e.target.value;
           this.ajaxListado(cantidadRegistros,paginaActual);
       });

       $("#frmBuscar").on("submit",(e)=>{
           e.preventDefault();
           var txtBuscar = $("#txtBuscar").val();
           var cantidadRegistros = $("#cantidadRegistros").val();
           var paginaActual = $("#paginaActual").val();
           this.ajaxListado(cantidadRegistros,1,txtBuscar);
       });
    }

    this.limpiarFormularios = () => {
        $("#frmCrear input,select").on("keyup change",(e)=>{
            e.preventDefault();
            $("#frmCrear span.error").remove();
        });
        $("#frmEditar input,select").on("keyup change",(e)=>{
            e.preventDefault();
            $("#frmEditar span.error").remove();              
        });
    }

    this.ver=(form,success)=>{
        $.ajax({
            url: this.url_ver,
            method:'GET',
            dataType:'json',
            data: form,
            beforeSend:function () {
                cargando('Procesando...')
            },
            success:success,
            error:function (data) {
                notificacion('error','Error',data.responseJSON);
            },
            complete:function () {
                stop();
            }
        });
    }

    this.ajaxListado = (cantidadRegistros = 10,paginaActual = 1,txtBuscar = null) => {
             $.ajax({
                    url:this.url_ajaxListado,
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
 
    this.guardar=(form, success)=>{
     
        $.ajax({
            url: this.url_guardar,
            method:'POST',
            dataType:'json',
            data: form,
            cache:false,
            contentType:false,
            processData:false,
            beforeSend:function () {
                $("#frmCrear span.error").remove();
                cargando('Procesando...');
            },
            success: success,
            error:function (data) {
                console.log(data);
                notificacion("error","Error","Error");

            },
            complete:function () {
                stop();
            }
        })
    }

    this.edit=(form, success)=>{
         $.ajax({
                url:this.url_edit,
                method:'GET',
                dataType:'json',
                data: form,
                beforeSend:function () {
                    cargando('Procesando...')
                 },
                 success:success,
                 error:function (data) {
                    notificacion('error','Error',data.responseJSON);
                 },
                  complete:function () {
                    stop();
                  }
         });        
    }

    this.modificar=(form, success)=>{
          
        $.ajax({
            url: this.url_modificar,
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
            success:success,
            error:function (data) {
                console.log(data);
                notificacion("error","Error","Error");

            },
            complete:function () {
                stop();
            }
        })      
    }

    this.success_habilitar=(data)=>{
        $("#modalHabilitar").modal("hide");
        notificacion("success","Habilitado",data);
        this.ajaxListado($("#cantidadRegistros").val(),$("#paginaActual").val());
    }

    this.success_inhabilitar=(data)=>{
        $("#modalInhabilitar").modal("hide");
        notificacion("success","Inhabilitado",data);
        this.ajaxListado($("#cantidadRegistros").val(),$("#paginaActual").val());        
    }

    this.habilitar = () => {
        $("#frmHabilitar").on("submit",(e)=>{
            e.preventDefault();
            $.ajax({
                url:this.url_habilitar,
                method:'POST',
                dataType:'json',
                data: new FormData($("#frmHabilitar")[0]),
                cache:false,
                contentType:false,
                processData:false,
                beforeSend:function () {
                    cargando('Procesando...');
                },
                success:this.success_habilitar,
                error:function (data) {
                    notificacion("error","Error",data.responseJSON);
                },
                complete:function () {
                    stop();
                }
            })
        });
    }

    this.inhabilitar = () => {
        $("#frmInhabilitar").on("submit",(e)=>{
            e.preventDefault();
            $.ajax({
                url:this.url_inhabilitar,
                method:'POST',
                dataType:'json',
                data: new FormData($("#frmInhabilitar")[0]),
                cache:false,
                contentType:false,
                processData:false,
                beforeSend:function () {
                    cargando('Procesando...');
                },
                success:this.success_inhabilitar,
                error:function (data) {
                    notificacion("error","Error",data.responseJSON);
                },
                complete:function () {
                    stop();
                }
            })
        });
    }

}
