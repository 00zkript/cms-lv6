
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
                    <input type="hidden" name="idmenu" id="idmenu" required>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="parienteEditar">Pariente:</label>
                                <select name="parienteEditar" id="parienteEditar" class="form-control selectpicker show-tick" data-size="5" data-live-search="true" title="[--Seleccione--]"> <option value="0">Sin Pariente</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombreEditar">Nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombreEditar" id="nombreEditar" required class="form-control" placeholder="Nombre">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="tipoRutaEditar">Tipo de ruta: <span class="text-danger">(*)</span></label>
                                <select id="tipoRutaEditar" name="tipoRutaEditar" class="form-control" required>
                                    <option value="" hidden>[---Seleccione---]</option>
                                    <option value="interna" >Interna</option>
                                    <option value="externa" >Externa</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="display:none" >
                            <div class="form-group">
                                <label for="rutaInternaEditar">Ruta interna: <span class="text-danger">(*)</span></label>
                                <select id="rutaInternaEditar" name="rutaInternaEditar" class="form-control">
                                        <option value="" hidden>[---Seleccione---]</option>
                                    @foreach($rutaInterna as $r)
                                        <option value="{{ $r->key }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="display:none" >
                            <div class="form-group">
                                <label for="rutaExternaEditar">Ruta Externa: <span class="text-danger">(*)</span></label>
                                <input type="text" name="rutaExternaEditar" id="rutaExternaEditar"  class="form-control"  placeholder="Ruta">
                            </div>
                        </div>





                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="posicionEditar">Orden: <span class="text-danger">(*)</span></label>
                                <select required data-size="5" name="posicionEditar" id="posicionEditar" class="form-control selectpicker show-tick"
                                        data-live-search="true" title="[--Seleccione--]">

                                </select>
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

