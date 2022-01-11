
    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i> Nuevo registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmCrear" autocomplete="off">
                        @csrf
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="idcategoria_producto">Categoria: <span class="text-danger">(*)</span></label>
                                <select name="idcategoria_producto" id="idcategoria_producto" required  class="form-control" >
                                    <option value="" selected hidden>[--- Seleccion ---]</option>
                                    @foreach ($categorias as $categoria )
                                        <option value="{{ $categoria->idcategoria_producto }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="titulo">Titulo: <span class="text-danger">(*)</span></label>
                                <input type="text" name="titulo" id="titulo" required class="form-control"  placeholder="Titulo">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="subtitulo">SubTitulo: </label>
                                <input type="text" name="subtitulo" id="subtitulo"  class="form-control"  placeholder="SubTitulo">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="contenido">Contenido: <span class="text-danger">(*)</span></label>
                                <textarea id="contenido" cols="30" rows="10" class="form-control" placeholder="Descripcion"></textarea>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h2>Modelo:</h2>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="modelo_desde">Desde: </label>
                                        <input type="text" name="modelo_desde" id="modelo_desde"  class="form-control"  placeholder="Desde">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="modelo_hasta">Hasta: </label>
                                        <input type="text" name="modelo_hasta" id="modelo_hasta"  class="form-control"  placeholder="Hasta">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h2>Caudal:</h2>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="caudal_desde">Desde: </label>
                                        <input type="text" name="caudal_desde" id="caudal_desde"  class="form-control"  placeholder="Desde">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="caudal_hasta">Hasta: </label>
                                        <input type="text" name="caudal_hasta" id="caudal_hasta"  class="form-control"  placeholder="Hasta">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h2>Presión:</h2>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="presion_desde">Desde: <span class="text-danger">(*)</span></label>
                                        <input type="text" name="presion_desde" id="presion_desde"  class="form-control"  placeholder="Desde">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="presion_hasta">Hasta: <span class="text-danger">(*)</span></label>
                                        <input type="text" name="presion_hasta" id="presion_hasta"  class="form-control"  placeholder="Hasta">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="imagen" >Imagen:</label>
                                <div class="file-loading">
                                    <input  id="imagen" name="imagen" type="file" class="file" >
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="pdf" >PDF:</label>
                                <div class="file-loading">
                                    <input  id="pdf" name="pdf" type="file" class="file" >
                                </div>
                            </div>
                        </div>





                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="estado">Estado: <span class="text-danger">(*)</span></label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="1" selected>Habilitado</option>
                                    <option value="0" >Inhabilitado</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

