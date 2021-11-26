<div class="form-group">
    <label for="nombre">Nombre :</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$user->name}}">
    @if ($errors->has('nombre'))
        <span class="help-block">
          <strong>{{ $errors->first('nombre') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="email">Email :</label>
    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
        @if ($errors->has('email'))
            <span class="invalid-feedback d-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
</div>

<div class="form-group">
    <label for="password">Contraseña:</label>
    <input type="password" class="form-control" id="password" name="password">
    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
         </span>
    @endif
</div>

<div class="form-group">
    <label for="title">Rol :</label>
        <select id="rol" type="" class="form-control" name="rol" >
            <option value="" disabled selected>Seleccionar rol </option>
            @foreach($roles as $key => $role)
                <option value="{{ $key }}" {{!empty($user) && $key === $user->is_admin ? 'selected' : '' }}>
                    {{ $role }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('rol'))
            <span class="invalid-feedback d-block">
                <strong>{{ $errors->first('rol') }}</strong>
            </span>
        @endif
</div>

