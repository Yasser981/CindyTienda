<div class="modal fade" id="addNewPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i> Agrege un nuevo usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form method="POST" action="{{ route('pagos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label bold uppercase"><strong>Nombre:</strong> </label>
                                <input type="text" class="form-control has-error bold " id="nombre" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}">
                                @if ($errors->has('nombre'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido" class="col-sm-3 control-label bold uppercase"><strong>Apellido:</strong> </label>
                                <input type="text" class="form-control has-error bold " id="apellido" name="apellido" placeholder="Apellido" value="{{ old('apellido') }}">
                                @if ($errors->has('apellido'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('apellido') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cedula" class="col-sm-3 control-label bold uppercase"><strong>Cedula:</strong> </label>
                                <input type="text" class="form-control has-error bold " id="cedula" name="cedula" placeholder="Cedula sin guines" value="{{ old('cedula') }}">
                                @if ($errors->has('cedula'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('cedula') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="articulo" class="col-sm-3 control-label bold uppercase"><strong>Articulo :</strong> </label>
                                <input type="text" class="form-control has-error bold " id="articulo" name="articulo" placeholder="Articulo" value="{{ old('articulo') }}">
                                @if ($errors->has('articulo'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('articulo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo" class="col-sm-3 control-label bold uppercase"><strong>Tipo</strong> </label>
                                
                                    <select id="tipo" type="" class="form-control" name="tipo">
                                        <option value="" disabled selected>Porfavor seleccione un tipo de pago</option>
                                        <option value="1">Abono </option>
                                        <option value="0">Prima </option>
                                    </select>
                                    @if ($errors->has('tipo'))
                                        <span class="invalid-feedback d-block">
                                            <strong>{{ $errors->first('tipo') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Pago" class="col-sm-3 control-label bold uppercase"><strong>Pago :</strong> </label>
                                <input type="number" class="form-control has-error bold " id="pago" name="pago" placeholder="Pago" value="{{ old('pago')}} " step=".01">
                                @if ($errors->has('pago'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('pago') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="saldo" class="col-sm-3 control-label bold uppercase"><strong>Saldo :</strong> </label>
                                <input type="number" class="form-control has-error bold " id="saldo" name="saldo" placeholder="Saldo" value="{{ old('saldo') }}" step=".01">
                                @if ($errors->has('saldo'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('saldo') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="dolar" name="dolar">
                                <label class="custom-control-label" for="dolar">Crear el recivo en dolares</label>
                                    <samp><br> Nota: Por defecto se crean en cordoba</samp>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i>Cerrar</button>
                    <button type="submit" class="btn btn-primary bold uppercase"><i class="fas fa-arrow-alt-circle-up"></i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
