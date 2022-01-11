<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('panel/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/css/waitMe.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/pnotify/PNotifyBrightTheme.css')}}">

    <style>
        [ui-pnotify].ui-pnotify.stack-bar-top {
            width: 100%;
        }
    </style>

</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 d-none d-md-block" >
                <img src="{{asset('panel/img/login-fondo.png')}}" class="img-fluid">
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" style="margin-top: 140px">
                <p class="text-center text-secondary" style="font-size: 25px"><i class="fa fa-coffee"></i> INICIO DE SESIÓN</p>
                <div class="card shadow">
                    <div class="card-body">
                        <form id="frmLogin">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="usuario">Usuario:</label>
                                        <input name="usuario" id="usuario" type="text" required placeholder="Usuario" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="clave">Contraseña:</label>
                                        <input name="clave" id="clave" type="password" required placeholder="*******" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="recuerdame" name="recuerdame"  value="1">
                                        <label class="custom-control-label" for="recuerdame">Recuerdame</label>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-sign-in"></i> INGRESAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{asset('panel/js/jquery.min.js')}}"></script>
    <script src="{{asset('panel/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('generales/js/waitMe.min.js')}}"></script>
    <script src="{{asset('panel/pnotify/PNotify.js')}}"></script>
    <script src="{{asset('panel/pnotify/PNotifyButtons.js')}}"></script>
    <script src="{{asset('generales/js/funciones.js')}}"></script>


    <script !src="">
        $(function () {

            verificarLogin();
        });



        var verificarLogin = () => {
            $("#frmLogin").on("submit",(e)=>{
                e.preventDefault();
                 $.ajax({
                        url:'{{route('login-panel.verificar')}}',
                        method:'POST',
                        dataType:'json',
                        data: new FormData($("#frmLogin")[0]),
                        cache:false,
                        contentType:false,
                        processData:false,
                        beforeSend:function () {
                            cargando();
                         },
                         success:function (data) {

                            if (!data.error){
                                $("#frmLogin button[type=submit]").prop('disabled',true);
                                notificacion('success','Exito',data.mensaje);
                                setTimeout(function () {
                                    cargando('Redirigiendo...');
                                    window.location.href = '{{route('home.index')}}';
                                },3000);

                            }else{
                                notificacion('error','Error',data.mensaje);
                            }

                         },
                         error:function (data) {

                             notificacion('error','Error',data.mensaje);
                         },
                          complete:function () {
                            stop();
                          }
                 });
            });
        }

    </script>
</body>
</html>
