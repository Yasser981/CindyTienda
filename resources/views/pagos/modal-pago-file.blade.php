<div class="col-md-6">
    <div class="form-group">
        <label for="nombre">Nombre :</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$pago->nombre}}">
        @if ($errors->has('nombre'))
            <span class="help-block">
          <strong>{{ $errors->first('nombre') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="apellido">Apellido :</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="{{$pago->apellido}}">
        @if ($errors->has('apellido'))
            <span class="invalid-feedback d-block">
                <strong>{{ $errors->first('apellido') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="cedula">Cedula :</label>
        <input type="text" class="form-control" id="cedula" name="cedula" value="{{$pago->cedula}}">
        @if ($errors->has('cedula'))
            <span class="help-block">
            <strong>{{ $errors->first('cedula') }}</strong>
         </span>
        @endif
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="articulo">Articulo :</label>
        <input type="text" class="form-control" id="articulo" name="articulo" value="{{$pago->articulo}}">
        @if ($errors->has('articulo'))
            <span class="help-block">
            <strong>{{ $errors->first('articulo') }}</strong>
         </span>
        @endif
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="abono">Abono :  {{$divisa }}</label>
        <input type="number" class="form-control" id="abono" name="abono" value="{{$pago->abona}}">
        @if ($errors->has('abono'))
            <span class="help-block">
            <strong>{{ $errors->first('abono') }}</strong>
         </span>
        @endif
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="saldo">Saldo : {{$divisa }}</label>
        <input type="number" class="form-control" id="saldo" name="saldo" value="{{$pago->saldo}}">
        @if ($errors->has('saldo'))
            <span class="help-block">
            <strong>{{ $errors->first('saldo') }}</strong>
         </span>
        @endif
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="dolar" name="dolar" {{ $pago->opcion_divisa != 0 ? 'checked' : '' }}>
                <label class="custom-control-label" for="dolar">Crear el recivo en dolares</label>
                <samp><br> Nota: Por defecto se crean en cordoba</samp>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="fecha">{{$pago->created_at->diffForHumans()}}</label>
      
    </div>
</div>
