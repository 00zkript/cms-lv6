
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
                                <label for="idcategoria_producto">Categoría: </label>
                                <select name="idcategoria_producto[]" id="idcategoria_producto"  class="form-control selectpicker" data-title="[--- Selección ---]"  multiple>
                                    @foreach ($categorias as $categoria )
                                        <option value="{{ $categoria->idcategoria_producto }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="idmarca">Marca: </label>
                                <select name="idmarca" id="idmarca"  class="form-control" >
                                    <option value="" selected hidden>[--- Selección ---]</option>
                                    @foreach ($marcas as $marca )
                                        <option value="{{ $marca->idmarca }}">{{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="codigo">Código: </label>
                                <input type="text" name="codigo" id="codigo" class="form-control"  placeholder="Código">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombre">Nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombre" id="nombre" required class="form-control"  placeholder="Nombre">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="precio">Precio: <span class="text-danger">(*)</span></label>
                                <input type="number" name="precio" id="precio" step="0.01" min="0" required class="form-control"  placeholder="Precio">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="stock">Stock: <span class="text-danger">(*)</span></label>
                                <input type="number" name="stock" id="stock" min="0" required class="form-control"  placeholder="Stock">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pt-3 pb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="destacado" name="destacado" value="1" >
                                <label class="custom-control-label" for="destacado">Destacado</label>
                            </div>
                        </div>




                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción: </label>
                                <textarea id="descripcion" name="descripcion" cols="30" rows="10" class="form-control" placeholder="Descripción"></textarea>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="contenido">Contenido: </label>
                                <textarea id="contenido" cols="30" rows="10" class="form-control" placeholder="Contenido"></textarea>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="imagen" >Imagen:</label>
                                <div class="file-loading">
                                    <input  id="imagen" name="imagen[]" required multiple type="file" class="file" >
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

