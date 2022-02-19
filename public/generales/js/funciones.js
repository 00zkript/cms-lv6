

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

const formDataToJson = (form) => {
    return Object.fromEntries(form);
}

const getFirstElemnto = (data) => {
    return data[Object.keys(data)[0]]
}


const allFilesData = (path, data, type = null ) => {

    const $urls = [];
    const $settings = [];

    if ( data.length > 0 ){

        data.forEach( (item ,idx) => {

            $urls.push(path+'/'+item.nombre);
            const setting = { caption : path+'/'+item.nombre , width : "120px", height : "120px", key : getFirstElemnto(item) };

            if (type){
                setting.type = type;
            }

            $settings.push(setting);

        })

    }

    return {urls : $urls, settings : $settings };
}


// funcion que devuelve la base url de la pagina web
const  base_url = (url = "") => window.location.origin+"/"+url ;

// funcion que simplifica las opcion y configuracion de la libreria toastr
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

// funcion para devolver una alerta personalizada  en cualquier div que tenga la clase "alerta"
const alerta = (type, message, title = "", time = 5000,align = "left")  => {
    align = title == "" ? "center" : align;
    type = type == "error" ? "danger" : type;

    const titleHtml = title == "" ? "" : `<h4 class="alert-heading" style="font-size: 20px;text-align: ${align}">${title}</h4>`;
    const html = `
        <div class="alert alert-${ type } alerta-body" role="alert" style="border-radius: 10px;">
          ${titleHtml}
          <div style="word-break: break-word; text-align: ${align}">
            ${ message }
          </div>
        </div>
    `;
    $(".alerta").html(html);

    setTimeout(function () {
        $(".alerta").html("");
    },time)

}

const alerta2 = ({
    el = ".alerta",
    align = 'left',
    title = '',
    message = '',
    type = 'error',
    time = 5000,
    position = "relative"
} = '')  => {

    align = title == "" ? "center" : align;
    type = type == "error" ? "danger" : type;

    const titleHtml = title == "" ? "" : `<h4 class="alert-heading" style="font-size: 20px;text-align: ${align}">${title}</h4>`;
    const html = `
        <div class="alert alert-${ type } alerta-body" role="alert" style="border-radius: 10px;position: ${position}">
          ${titleHtml}
          <div style="word-break: break-word; text-align: ${align}">
            ${ message }
          </div>
        </div>
    `;
    $(el).html(html);

    setTimeout(function () {
        $(el).html("");
    },time)

}


// funcion apra valdiar el el eamil
const validarEmail = (valor) => {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
        return true;
    } else {
        return false;
    }
}


// funcion  perzonalixada para la convercion de un numero a formato telefonico . resultado : 333-333-333
const formatPhone = (numero) => {
    const res = numero.toString().replace(/([0-9]{3})(\B)/g,"$1-");

    return res;
}


const soloLetras = function(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();

    letras = " Ã¡Ã©Ã­Ã³ÃºabcdefghijklmnñÃ±opqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) != -1 || tecla_especial){
        return true
    }

    return e.preventDefault();


}


// funcion que sirve de valdiacion para los input de  tipo text que se necesita convertir en numero
const convertirANumero = e => {
    e.target.value = e.target.value.replace(/[^0-9]/g, "");
}




const soloNumeros = function(e) {

    var charCode = (e.which) ? e.which : e.keyCode;
    e.target.value = e.target.value.replace(/[^0-9]/g, "");

    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return e.preventDefault();
    }

    return true;
}

// funcion para validar contraseñas  con un minimo 8 caracteres y un maxiomo de 15 caracteres
const validarPassword = e => {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;

    if (regex.test(valor)){
        return true;
    } else {
        return false;
    }
}



// funcion para formatear fecha . resultado : 31/12/2021
const formatFecha = fecha => {
    let date = new Date( Date.parse( fecha ))
    let d = date.getDate().toString().padStart(2,0);
    let m = date.getMonth().toString().padStart(2,0);
    let Y = date.getFullYear();

    return d+'/'+m+'/'+Y;
}

const convertFloat = (number,decimal = 2) => {
        return parseFloat(number).toFixed(2);
}

// funcion para remoover un item de un arreglo
const removeItemArray = ( arr, item ) => {
    return arr.filter( function( e ) {
        return e !== item;
    } );
};

// funcion para devolver la posicion actual del scroll
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

// quita las etiquetas html del texto ingresado
const removeHmlFromText = (text) => {
    return text.replace(/(<([^>]+)>)/ig, '');
}


// retorna solo los números  y guiones del texto ingresado
const numberAndDash = (text) => {
    return text.replace(/([^0-9-])/g,'');
}


const scrollToAnimate = (offset, less = 0, speed = 1000 ) => {
    $('html, body').animate(
        {scrollTop: offset - less
    }, speed);

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

// Retorna un número aleatorio entre 0 (incluido) y 1 (excluido)
const getRandom = () => {
    return Math.random();
}

// Retorna un número aleatorio entre min (incluido) y max (excluido)
const getRandomArbitrary = (min, max) => {
    return Math.random() * (max - min) + min;
}

// Retorna un entero aleatorio entre min (incluido) y max (excluido)
// ¡Usando Math.round() te dará una distribución no-uniforme!
const getRandomInt = (min, max) => {
    return Math.floor(Math.random() * (max - min)) + min;
}


const $getFecha = {
    unix() {
        return Date.now();
    } ,
    fechaString() {
        return new Date(this.unix())
    } ,
    anio() {
        return this.fechaString().getFullYear();
    } ,
    mes() {
        return (this.fechaString().getMonth() + 1).toString().padStart(2,0);
    } ,
    dia() {
        return this.fechaString().getDate().toString().padStart(2,0);
    } ,
    hora() {
        return this.fechaString().getHours().toString().padStart(2,0);
    } ,
    min() {
        return this.fechaString().getMinutes().toString().padStart(2,0);
    } ,
    seg() {
        return this.fechaString().getSeconds().toString().padStart(2,0);
    } ,
    date() {
        return this.anio() +'-'+ this.mes() +'-'+ this.dia();
    } ,
    time() {
        return this.hora() +':'+ this.min() +':'+ this.seg();
    } ,
    now() {
        return this.date()+' '+this.time();
    } ,
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


// funcion para el catch de axxios en caso no se nececite un validacion personalizada
const errorResponse = (error) => {
    const response = error.response;
    const data = response.data;
    let mensaje = '';


    if (response.status == 422){
        toast("error",listErrors(data),data.mensaje);

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

    return false;
}


// funcion para el catch de axxios en caso no se nececite un validacion personalizada
const errorResponseAlerta = (error) => {
    const response = error.response;
    const data = response.data;
    let mensaje = '';
    $('body').waitMe('hide');

    if (response.status == 422){
        alerta("error",listErrors(data),data.mensaje);

    }

    if (response.status == 500){
        alerta("error","Error del servidor, contácte con soporte.");
    }


    if (response.status == 419){
        alerta("error","Error del servidor, contácte con soporte.");
    }

    if (response.status == 400){
        mensaje = data.mensaje
        alerta("error",mensaje);

    }

    return false;
}

// funcion para el catch de axxios en caso no se nececite un validacion personalizada
const errorResponseModal = (error) => {
    const response = error.response;
    const data = response.data;
    let mensaje = '';
    $('body').waitMe('hide');

    if (response.status == 422){
        alertaModal(listErrors(data),data.mensaje);

    }

    if (response.status == 500){
        alertaModal("Error del servidor, contácte con soporte.");
    }


    if (response.status == 419){
        alertaModal("Error del servidor, contácte con soporte.");
    }

    if (response.status == 400){
        mensaje = data.mensaje
        alertaModal(mensaje);

    }

    return false;
}

var waitMeEffectBounce = {
    effect: 'bounce',
    text: 'POR FAVOR ESPERA...',
    bg: 'rgba(255,255,255,0.7)',
    color: '#27A8E0',
    maxSize: '',
    waitTime: -1,
    source: 'img.svg',
    textPos: 'vertical',
    fontSize: '',
    onClose: function(el) {}
}
