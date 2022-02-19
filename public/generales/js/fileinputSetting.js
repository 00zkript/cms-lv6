const fileinputSetting = ({
    dropZoneTitle = 'Arrastre la imagen aquí',
    allowedFileTypes = ["image"],
    allowedFileExtensions  = false,
    overwriteInitial = false,
    fileActionSettings = {
        howRemove  : false,
        showUpload  : false,
        showZoom    : true,
        showDrag    : false,
    },
    initialPreview = [],
    initialPreviewConfig = false,
    uploadUrl = false ,
    deleteUrl = false ,
    extra = false ,
    others = {}
} = '') => {

    const setting = {
        theme                       : 'fa',
        language                    : 'es',
        uploadAsync                 : false,
        dropZoneTitle               : dropZoneTitle,
        showUpload                  : false,
        // required                    : required,
        // showRemove                  : showRemove,
        allowedFileTypes            : allowedFileTypes,
        overwriteInitial            : overwriteInitial,
        initialPreviewAsData        : true,
        fileActionSettings          : fileActionSettings,
        initialPreview              : initialPreview,
        initialPreviewConfig        : initialPreviewConfig,
    };

    if(allowedFileExtensions){
        // setting.allowedFileExtensions = ['jpg', 'png', 'jpeg','gif','webp','tiff','tif','svg','bmp','mp4'];
        setting.allowedFileExtensions = allowedFileExtensions;
    }

    if(uploadUrl){
        setting.uploadUrl = uploadUrl;
        setting.uploadExtraData = extra;
    }

    if(deleteUrl){
        setting.deleteUrl = deleteUrl;
        setting.deleteExtraData = extra;
    }



    return {...setting, ...others }


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


// EXAMPLE SORT IMAGES
/*$(container).on('filesorted', function(event, params) {
    // console.log('preview',params.previewId,'old',params.oldIndex,'new index',params.newIndex,'stack',params.stack);
    const form = new FormData();
    form.append('stack',JSON.stringify(params.stack))


    // Send param "order" alias stack

});*/





