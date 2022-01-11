
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-edit"></i> Modificar registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditar" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="idproducto" id="idproducto" required>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="idcategoria_productoEditar">Categoria: <span class="text-danger">(*)</span></label>
                                <select name="idcategoria_productoEditar" id="idcategoria_productoEditar" required  class="form-control" >
                                    <option value="" >[--- Seleccion ---]</option>
                                    @foreach ($categorias as $categoria )
                                        <option value="{{ $categoria->idcategoria_producto }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="tituloEditar">Titulo: <span class="text-danger">(*)</span></label>
                                <input type="text" name="tituloEditar" id="tituloEditar" required class="form-control"  placeholder="Titulo">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="subtituloEditar">SubTitulo: </label>
                                <input type="text" name="subtituloEditar" id="subtituloEditar"  class="form-control"  placeholder="SubTitulo">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="contenidoEditar">Contenido: <span class="text-danger">(*)</span></label>
                                <textarea id="contenidoEditar" cols="30" rows="10" class="form-control" placeholder="Descripcion"></textarea>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h2>Modelo:</h2>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="modelo_desdeEditar">Desde: </label>
                                        <input type="text" name="modelo_desdeEditar" id="modelo_desdeEditar"  class="form-control"  placeholder="Desde">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="modelo_hastaEditar">Hasta: </label>
                                        <input type="text" name="modelo_hastaEditar" id="modelo_hastaEditar"  class="form-control"  placeholder="Hasta">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h2>Caudal:</h2>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="caudal_desdeEditar">Desde: </label>
                                        <input type="text" name="caudal_desdeEditar" id="caudal_desdeEditar"  class="form-control"  placeholder="Desde">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="caudal_hastaEditar">Hasta: </label>
                                        <input type="text" name="caudal_hastaEditar" id="caudal_hastaEditar"  class="form-control"  placeholder="Hasta">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h2>Presión:</h2>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="presion_desdeEditar">Desde: </label>
                                        <input type="text" name="presion_desdeEditar" id="presion_desdeEditar"  class="form-control"  placeholder="Desde">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label for="presion_hastaEditar">Hasta: </label>
                                        <input type="text" name="presion_hastaEditar" id="presion_hastaEditar"  class="form-control"  placeholder="Hasta">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="imagenEditar" >Imagen:</label>
                                <div class="file-loading">
                                    <input  id="imagenEditar" name="imagenEditar" type="file" class="file" >
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="pdfEditar" >PDF:</label>
                                <div class="file-loading">
                                    <input  id="pdfEditar" name="pdfEditar" type="file" class="file" >
                                </div>
                            </div>
                        </div>





                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="estadoEditar">Estado: <span class="text-danger">(*)</span></label>
                                <select name="estadoEditar" id="estadoEditar" class="form-control" required>
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

