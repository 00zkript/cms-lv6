@extends('web.template.plantilla')

@section('titulo', 'Contacto')

@section('meta')
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Contacto | {{ $empresaGeneral->titulo_general }}" />
    <meta property="og:description" content="{{ $empresaGeneral->seo_description }}" />
    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:site_name" content="{{ $empresaGeneral->titulo_general }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $empresaGeneral->seo_description }}" />
    <meta name="twitter:title" content="Contacto | {{ $empresaGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ '@' . $empresaGeneral->titulo_general }}" />
    <meta name="twitter:creator" content="{{ '@' . $empresaGeneral->titulo_general }}" />
@endsection

@section('css')
<style type="text/css">
  .menu {
     position: relative;
  }
  .menu-on{
    position: fixed;
  }
</style>
@endsection

@section('cuerpo')



    <section class="container" style="width: 100%;padding-top: 3%;">

        <div class="row-flex">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ajustab">

                <img src="web/img/contacto_imagencita.png">

            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ajustab">

                <div>

                    <div class="titulo-duo font-weight-bold">
                        <h2>ESTAMOS <span>PARA ATENDERTE</span></h2>
                    </div>

                    <article class="contactoespacio">Por eso nos comprometemos a responder a tus preguntas y comentarios en
                        el menor tiempo posible. Por favor complete el siguiente formulario y consúltanos sobre cualquier
                        tema relacioanda a nuestro producto, marcas, stock, precio, entre otro.</article>



                    <form class="form_register" id="formulariodatos" action="phpmailer/enviarmail.php" method="POST">

                        <div class="marco_contacto">

                            <input class="ajustarc1" type="text" name="nombre" placeholder="Nombre o razon social">

                            <input class="ajustarc2" type="number" name="telefono" placeholder="Tel.:  Cel.:" required>

                            <input class="ajustarc3" type="email" name="correo" placeholder="Correo" required>

                            <input class="ajustarc4" type="text" name="asunto" placeholder="Asunto">

                            <input class="ajustarc5" type="text" name='mensaje' placeholder='mensaje'>



                            <div id="msgContacto" style="display:none;width: 100%;" class="alert alert-success"
                                role="alert">





                            </div>

                            <p class="contactojustificar1"><input style="float: right;" type="submit" class="miboton"
                                    id="enviar" name="enviar" value="Enviar"></p>

                        </div>



                    </form>

                </div>

            </div>

        </div>


    </section>


    <section class="container-fluid sin-padding">
        <div class="row">
            <div class="col-xs-12">
                <iframe
                    src="{{ $contactoGeneral->ubicacion }}"
                    width="100%" height="450" style="display: block;border: 0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>







@endsection

@push('js')

    <script>
        const URL_ENVIOCONTACTO = "{{ route('web.contacto.enviar') }}";

        $(document).on("submit", "#formulariodatos", function(e) {
            e.preventDefault();

            const form = new FormData($(this)[0]);

            axios.post(URL_ENVIOCONTACTO, form)
                .then(response => {
                    const data = response.data;


                    $("#msgContacto").html("Gracias por comunicarte con nosotros, en breve te responderemos.");
                    $("#msgContacto").show(2000);

                    setTimeout(function() { $("#msgContacto").hide(2000); }, 8000);
                    $("#formulariodatos")[0].reset();


                })
                .catch(errorResponse)






        })
    </script>

@endpush
