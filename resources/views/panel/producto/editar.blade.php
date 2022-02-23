
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
                                <select name="idcategoria_productoEditar[]" id="idcategoria_productoEditar" class="form-control selectpicker" data-title="[--- Seleccion ---]" multiple>
                                    @foreach ($categorias as $categoria )
                                        <option value="{{ $categoria->idcategoria_producto }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="codigoEditar">Código: </label>
                                <input type="text" name="codigoEditar" id="codigoEditar" class="form-control"  placeholder="Código">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombreEditar">nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombreEditar" id="nombreEditar" required class="form-control"  placeholder="nombre">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="precioEditar">Precio: <span class="text-danger">(*)</span></label>
                                <input type="number" name="precioEditar" id="precioEditar" step="0.01" min="0" required class="form-control"  placeholder="Precio">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="stockEditar">Stock: <span class="text-danger">(*)</span></label>
                                <input type="number" name="stockEditar" id="stockEditar" min="0" required class="form-control"  placeholder="Stock">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pt-3 pb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="destacadoEditar" name="destacadoEditar" value="1" >
                                <label class="custom-control-label" for="destacadoEditar">Destacado</label>
                            </div>
                        </div>



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="descripcionEditar">Descripción: </label>
                                <textarea id="descripcionEditar" name="descripcionEditar" cols="30" rows="10" class="form-control" placeholder="Descripción"></textarea>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="contenidoEditar">Contenido: </label>
                                <textarea id="contenidoEditar" cols="30" rows="10" class="form-control" placeholder="Descripcion"></textarea>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="imagenEditar" >Imagen:</label>
                                <div class="file-loading">
                                    <input  id="imagenEditar" name="imagenEditar[]" multiple type="file" class="file" >
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

