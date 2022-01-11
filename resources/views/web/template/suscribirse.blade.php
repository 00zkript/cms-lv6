<section class="parallax fondo-negro fondo-absoluto mt-0" data-parallax="scroll" data-position="top" data-bleed="10" data-parallax-speed="0.6" style="background-image:url('img/slider-3.jpg');">
    <div class="parallax-body">
        <div class="container">
          <form class="form-group" id="formSuscripcion">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5 col-md-6 col-12">
                    <h3><b>SUSCRÍBETE</b></h3>
                    <p>Enterate de nuestro post informativos que complementarán tu aprendizaje profesional. Además para los suscriptores tenemos un descuento adicional por promoción</p>
                </div>
                <div class="col-lg-5 offset-lg-1 col-md-6 col-12">
                    <label><b>CORREO</b></label>
                    <input type="email" placeholder="" required id="email" name="email" class="input-sus form-control">
                    <button class="btn-eclipse fw-normal" type="submit" style="margin: 10px auto;font-size: 12pt;">SUSCRÍBETE</button>
                </div>
            </div>
          </form>
        </div>
    </div>
</section>




@push('js')



<script>

    const URL_ENVIOCONTACTO = "{{ route('web.suscripcion.enviar') }}";

    $(document).on("submit","#formSuscripcion",function(e) {
        e.preventDefault();


        const form = new FormData($(this)[0]);

            axios.post(URL_ENVIOCONTACTO,form)
            .then(response => {
                const data = response.data;

                toast("success","Se envió correctamente la solicitud de suscripción.");
                $("#formSuscripcion")[0].reset();

            })
            .catch(errorToast)






    })



</script>



@endpush
