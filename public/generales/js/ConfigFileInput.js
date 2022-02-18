const configFileInput = ({
        titulo = 'Arrastre la imagen aquí',
        data = false,
        extra = false ,
        tipo_archivo = ["image"],
        tipo_archivo_extenciones = false,
        url_file_upload = false ,
        url_file_remove = false ,
        file_icon_remove = false,
        file_icon_upload = false,
        file_icon_zoom = true,
        file_icon_drag = false,
        required = false,
        otros = {}
    } = '') => {

    const config = {
        theme                       : 'fa',
        language                    : 'es',
        uploadAsync                 : false,
        dropZoneTitle               : titulo,
        showUpload                  : false,
        required                   : required,
        // showRemove               : true,
        allowedFileTypes            : tipo_archivo,
        fileActionSettings          : {
            showRemove  : file_icon_remove,
            showUpload  : file_icon_upload,
            showZoom    : file_icon_zoom,
            showDrag    : file_icon_drag,
        },

        overwriteInitial            : false,
        initialPreviewAsData        : true,
        initialPreview              : data ?  data.url : false,
        initialPreviewConfig        : data ?  data.datos : false,

    };

    if(tipo_archivo_extenciones){
        // config.allowedFileExtensions = ['jpg', 'png', 'jpeg','gif','webp','tiff','tif','svg','bmp','mp4'];
        config.allowedFileExtensions = tipo_archivo_extenciones;
    }

    if(url_file_upload){
        config.uploadUrl = url_file_upload;
        config.uploadExtraData = extra;
    }

    if(url_file_remove){
        config.deleteUrl = url_file_remove;
        config.deleteExtraData = extra;
    }



    return {...config, ...otros }


}


const getFilesCount = (container) => {
    // returns count of files (pending upload)\
    return $(container).fileinput('getFilesCount');
}

const getFilesTotalCount = (container) => {
    // returns count of files (pending upload plus files already uploaded and set via initial preview)
    return $(container).fileinput('getFilesCount', true);
}

const getFileStack = (container) => {
    const filestack = $(container).fileinput('getFileStack'), fstack = [];
    $.each(filestack, function(fileId, fileObj) {
        if (fileObj !== undefined) {
            fstack.push(fileObj);
        }
    });

    return fstack;
}


const sortImages = (sortImages) => {
    $('#imagenEditar').on('filesorted', function(event, params) {
        // console.log('preview',params.previewId,'old',params.oldIndex,'new index',params.newIndex,'stack',params.stack);
        const form = new FormData();
        form.append('stack',JSON.stringify(params.stack))

        axios({
            method : "post",
            url: sortImages,
            data: form
        })
        .then( response => {
            if(response.status === 200){
                console.log(response.data);
            }else{
                console.log(response)
            }
        })
        .catch( e => {
            console.log(e)
        })





    });
}


const sortImagesCustom = (container,sortImages) => {
    $(container).on('filesorted', function(event, params) {
        // console.log('preview',params.previewId,'old',params.oldIndex,'new index',params.newIndex,'stack',params.stack);
        const form = new FormData();
        form.append('stack',JSON.stringify(params.stack))

        axios({
            method : "post",
            url: sortImages,
            data: form
        })
        .then( response => {
            if(response.status === 200){
                console.log(response.data);
                notificacion("success","Modificación exitosa",response.data);
            }else{
                console.log(response)
            }
        })
        .catch( e => {
            console.log(e)
        })





    });
}




