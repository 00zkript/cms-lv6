
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
                                <label for="rol">Rol: <span class="text-danger">(*)</span></label>
                                <select name="rol" id="rol" class="form-control" required>
                                    <option value="" hidden selected disabled>[--Seleccione--]</option>
                                    @foreach($roles AS $r)
                                        <option value="{{$r->idrol}}" >{{$r->rol}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="usuario">Usuario: <span class="text-danger">(*)</span></label>
                                <input type="text" name="usuario" id="usuario" required class="form-control" maxlength="50" placeholder="Usuario">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="clave">Clave: <span class="text-danger">(*)</span></label>
                                <input type="password" name="clave" id="clave" required class="form-control" maxlength="20" placeholder="********">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombres">Nombres: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombres" id="nombres" required class="form-control" maxlength="50" placeholder="Nombres">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="apellidos">Apellidos: <span class="text-danger">(*)</span></label>
                                <input type="text" name="apellidos" id="apellidos" required class="form-control" maxlength="50" placeholder="Apellidos">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="correo">Correo: <span class="text-danger">(*)</span></label>
                                <input type="email" name="correo" id="correo" required class="form-control" maxlength="100" placeholder="Ejemplo@correo.com">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="foto" >Foto:</label>
                                <div class="file-loading">
                                    <input  id="foto" name="foto" type="file" class="file" >
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

