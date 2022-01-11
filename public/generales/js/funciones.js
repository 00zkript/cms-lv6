

try {
    PNotify.defaults.textTrusted = true;
    PNotify.defaults.styling = 'brighttheme';
    PNotify.defaults.icons = 'fontawesome4';
} catch (error) {
    console.log("no se importo pnotify");
}

var notificacion = function (tipo,titulo,mensaje,tiempo=5000) {

        PNotify.alert({
            type:tipo,
            title: titulo,
            text: mensaje,
            addClass: 'stack-bar-top',
            cornerClass: 'ui-pnotify-sharp',
            shadow: false,
            width: '100%',
            delay: tiempo,
            stack:{
                'dir1': 'down',
                'firstpos1': 0,
                'spacing1': 0,
                'push': 'top'
            },

        })

}

var cargando = function (texto = 'Cargando') {
    $('body').waitMe({
        effect : 'timer',
        text : texto,
        bg : 'rgba(255,255,255,0.7)',
        color : '#3F53FF',
        maxSize : '',
        waitTime : -1,
        textPos : 'vertical',
        fontSize : '',
        source : '',
    });
}

var stop = function () {
    $('body').waitMe("hide");
}

var vacio = function (param) {
    if (param === "" || param === null || param === " "){
        return true;
    }else{
        return false;
    }
}

function formatoFecha(string) {
    var info = string.split('-').reverse().join('/');
    return info;
}

const toast = (type, message, title = "",time = 5000) => {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        // "positionClass": "toast-top-full-width",
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": time,
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "escapeHtml": false
    }

    toastr[type](message,title)
}





const convertToFormData = (formData, data, parentKey) => {
    if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
        Object.keys(data).forEach(key => {
            convertToFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
        });
    } else {
        const value = data == null ? '' : data;

        formData.append(parentKey, value);
    }
}

const jsonToFormData = (data) => {
    const formData = new FormData();

    convertToFormData(formData, data);

    return formData;
}


const listErrorsForm = (errors) => {
    let html = "<ul style='text-align: left'>";
    errors.forEach(error => {
        html += "<li>"+error+"</li>";
    } )
    html += "</ul>";

    return html;
}

// funcion para el caso de haber un error 427 (error de validación) en la peticion de axios
const listErrors = (data) => {
    let errors = data.errors;

    let msj = `<ul style="text-align: left">`;
    for(const i in errors){
        msj += `<li> ${ errors[i][0] } </li>`;
    }
    msj += `</ul>`;

    return msj;
}


const errorCatch = ( error ) => {

    const response = error.response;
    const data = response.data;
    let mensaje = '';
    stop();


    if (response.status == 422){
        notificacion("error","Error",listErrors(data));

    }

    if (response.status == 500){
        notificacion("error","Error","Error del servidor, contácte con soporte.");
    }


    if (response.status == 419){
        notificacion("error","Error","Error del servidor, contácte con soporte.");
    }

    if (response.status == 400){
        mensaje = data.mensaje
        notificacion("error","Error",mensaje);

    }

    console.log(data);
    return false;


}



const errorToast = ( error ) => {

    const response = error.response;
    const data = response.data;
    let mensaje = '';


    if (response.status == 422){
        toast("error",listErrors(data));

    }

    if (response.status == 500){
        toast("error","Error del servidor, contácte con soporte.");
    }


    if (response.status == 419){
        toast("error","Error del servidor, contácte con soporte.");
    }

    if (response.status == 400){
        mensaje = data.mensaje
        toast("error",mensaje);

    }

    console.log(data);
    return false;


}

const limpiarFormularios = () => {
    $("#frmCrear input,select").on("keyup change",(e)=>{
        e.preventDefault();
        $("#frmCrear span.error").remove();
    });
    $("#frmEditar input,select").on("keyup change",(e)=>{
        e.preventDefault();
        $("#frmEditar span.error").remove();
    });
}



const getOffset = (el) => {
    const rect = el.getBoundingClientRect();
    return {
        top: rect.top + window.scrollY,
        left: rect.left + window.scrollX,
    };
}

// funcion para hacer un scroll en un pocion espeicfica
const scrollTo = (selector, less = 100, time = 100 ) => {
    setTimeout(function(){
        window.scrollTo({
            top: getOffset(document.querySelector(selector)).top - less ,
            behavior: 'smooth'
        });
    }, time)

}
