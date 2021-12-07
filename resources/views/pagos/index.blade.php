@extends('adminlte::page')

@section('content')
    <!-- Main content -->
    <div class="container">

        <h4 class="page-title">Pagos
        <a href="#"  id="btnnn" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNewPago">Agregar un nuevo pago</a>
        @if ($errors->any())
           <samp style="color: red;">hubo errores</samp>
        @endif
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                @include('pagos.table')
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        @include('pagos.create')
    </div>
    <!-- /.content -->
@endsection
