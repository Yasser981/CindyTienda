<div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-square"></i> Agrege un nuevo usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre" class="col-sm-3 control-label bold uppercase"><strong>Nombre:</strong> </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control has-error bold " id="nombre" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" >
                            @if ($errors->has('nombre'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label bold uppercase"><strong>Email:</strong> </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control has-error bold " id="email" name="email" placeholder="Correos" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label bold uppercase">contraseña</label>
                        <div class="col-sm-12">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" value="{{ old('password') }}" >
                            @if ($errors->has('password'))
                                <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="admin" class="col-sm-3 control-label bold uppercase"><strong>Admin:</strong> </label>
                        <div class="col-sm-12">
                            <select id="admin" type="" class="form-control" name="admin">
                                <option value="" disabled selected>Seleccionar rol </option>
                                <option value="1">Admin </option>
                                <option value="0">Otro </option>
                            </select>
                            @if ($errors->has('admin'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('admin') }}</strong>
                                </span>
                            @endif
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
