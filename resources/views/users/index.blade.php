@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios del sistema</h1>
@endsection

@section('content')
    <!-- Main content -->
    <div class="container">

        <h4 class="page-title">Users
        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNewUser">Agregar Nuevo Usuario</a>
        @if ($errors->any())
           <samp style="color: red;">hubo errores</samp>
        @endif
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                @include('users.table')
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        @include('users.create')
    </div>
    <!-- /.content -->
@endsection
