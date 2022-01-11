@extends('panel.template.gentella')
@section('cuerpo')

    <div class="container-fluid">
        <form id="frmEditar">
            @csrf
            @method('PUT')
            <input type="hidden" name="idcontacto" id="idcontacto" value="{{$contacto->idcontacto}}">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #2a3f54">
                            <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Contactanos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-refresh"></i> Modificar</button>
                                    <hr>
                                </div>


                                <div class="col-12">


                                    <div class="row">
                                        <h3>Datos generales:</h3>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="direccion" class="font-weight-bold" style="font-size: 20px" >Dirección:</label>
                                                <textarea id="direccion"  class="form-control">{{$contacto->direccion}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="telefono" class="font-weight-bold" style="font-size: 20px">Telefono #1:</label>
                                                <input type="text"  id="telefono" name="telefono" class="form-control" value="{{ $contacto->telefono }}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="telefono2" class="font-weight-bold" style="font-size: 20px">Telefono #2:</label>
                                                <input type="text"  id="telefono2" name="telefono2" class="form-control" value="{{ $contacto->telefono2 }}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="telefono3" class="font-weight-bold" style="font-size: 20px">Telefono #3:</label>
                                                <input type="text"  id="telefono3" name="telefono3" class="form-control" value="{{ $contacto->telefono3 }}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"  >
                                            <div class="form-group">
                                                <label for="whatsapp" class="font-weight-bold" style="font-size: 20px">Whatsapp:</label>
                                                <input type="text" data-mask="999999999" id="whatsapp" name="whatsapp" class="form-control" value="{{ $contacto->whatsapp }}">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="correo" class="font-weight-bold" style="font-size: 20px">Correo:</label>
                                                <textarea  id="correo" name="correo" class="form-control">{{$contacto->correo}}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="facebook" class="font-weight-bold" style="font-size: 20px">Facebook:</label>
                                                <textarea  id="facebook" name="facebook" class="form-control">{{$contacto->facebook}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="instagram" class="font-weight-bold" style="font-size: 20px">Instagram:</label>
                                                <textarea  id="instagram" name="instagram" class="form-control">{{$contacto->instagram}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="pinterest" class="font-weight-bold" style="font-size: 20px">Pinterest:</label>
                                                <textarea  id="pinterest" name="pinterest" class="form-control">{{$contacto->pinterest}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="twitter" class="font-weight-bold" style="font-size: 20px">Twitter:</label>
                                                <textarea  id="twitter" name="twitter" class="form-control">{{$contacto->twitter}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="youtube" class="font-weight-bold" style="font-size: 20px">Youtube:</label>
                                                <textarea  id="youtube" name="youtube" class="form-control">{{$contacto->youtube}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="linkedin" class="font-weight-bold" style="font-size: 20px">Linkedin:</label>
                                                <textarea  id="linkedin" name="linkedin" class="form-control">{{$contacto->linkedin}}</textarea>
                                            </div>
                                        </div>



                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="googleMaps" class="font-weight-bold" style="font-size: 20px">Google Maps:</label>
                                                <textarea style="height: 150px;" id="googleMaps" name="googleMaps" class="form-control">{{$contacto->ubicacion}}</textarea>
                                            </div>
                                        </div>


                                    </div>
                                    <hr>



                                </div>




                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('js')

    <script !src="">

        const URL_MODIFICAR = "{{ route('contacto.update','update') }}";




        var modificar = () => {
            $("#frmEditar").on("submit",(e)=>{
                e.preventDefault();

                var form = new FormData($("#frmEditar")[0]);
                form.append('direccion',CKEDITOR.instances.direccion.getData());
               // form.append('telefono',CKEDITOR.instances.telefono.getData());
               // form.append('correo',CKEDITOR.instances.correo.getData());
              //  form.append('googleMaps',CKEDITOR.instances.googleMaps.getData());
              /*  form.append('facebook',CKEDITOR.instances.facebook.getData());
                form.append('instagram',CKEDITOR.instances.instagram.getData());
                form.append('twitter',CKEDITOR.instances.twitter.getData());
                form.append('youtube',CKEDITOR.instances.youtube.getData());*/

                cargando('Procesando...');

                axios.post(URL_MODIFICAR,form)
                .then( response => {
                    const data = response.data;

                    stop();
                    notificacion("success","Información modificada",data);
                    location.reload();
                })
                .catch(errorCatch)


            });
        }


        $(function () {
            modificar();

            CKEDITOR.replace('direccion',{
                height : 200
            });

            // CKEDITOR.replace('telefono',{
            //     height : 200
            // });

            // CKEDITOR.replace('correo',{
            //     height : 200
            // });

            // CKEDITOR.replace('googleMaps',{
            //     height : 200
            // });

            // CKEDITOR.replace('facebook',{
            //     height : 200
            // });

            // CKEDITOR.replace('instagram',{
            //     height : 200
            // });

            // CKEDITOR.replace('twitter',{
            //     height : 200
            // });

            // CKEDITOR.replace('youtube',{
            //     height : 200
            // });

        });




    </script>
@endpush
