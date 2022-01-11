
class Modals{
    
    constructor(id){
        this.id = id;
    }

    modalCrear = (callback) => {
        $("#btnModalCrear").on("click",callback);
    }
    
    modalHabilitarEInhabilitar = () => {
        const id = this.id; 

        $(document).on("click",".btnModalHabilitar",function(e){
            e.preventDefault();
            const dataId = $(this).closest('div.dropdown-menu').data(id);
            $("#frmHabilitar input[name="+id+"]").val(dataId);
            $("#modalHabilitar").modal("show");
        });

        $(document).on("click",".btnModalInhabilitar",function(e){
            e.preventDefault();
            var dataId = $(this).closest('div.dropdown-menu').data(id);
            $("#frmInhabilitar input[name="+id+"]").val(dataId);
            $("#modalInhabilitar").modal("show");
        });
    }
    
    modalEditar = (callback) => {
        const id = this.id;
        $(document).on("click",".btnModalEditar",function(e){
            e.preventDefault();
            var dataId = $(this).closest('div.dropdown-menu').data(id);
    
           const params = { "id" : dataId } 
    
            crud.edit(params , callback);
             
        });
    }
 

    modalVer = (callback) => {
        const id = this.id;
        $(document).on("click",".btnModalVer",function(e){
            e.preventDefault();
            var dataId = $(this).closest('div.dropdown-menu').data(id);
            
            const params = { "id" : dataId } 

            crud.ver(params, callback);
        })
    }


}