@section('style')
    <!-- data table css -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fixedHeader.bootstrap.min.css') }}">
    <style>
        .ticket {
            font-size: 12px;
            font-family: 'Times New Roman';
            width: 155px;
            max-width: 155px;

        }

        .centrado {
            text-align: center;
            align-content: center;
        }

        img {
            max-width: inherit;
            width: inherit;
        }
    </style>
@stop

<div class="card-body table-responsive">
    <table id="data_table" class="table table-bordered table-striped table-hover dataTable w-100">
        <thead>
        <tr>
            <th>No#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Articulo</th>
            <th>Abono</th>
            <th>Prima</th>
            <th>Saldo</th>
            <th>Fecha</th>
            <th>Accion</th>
        </tr>
        </thead>
    </table>
</div>
<div class="modal" id="VerPagoModal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Modal</h5>
                <button type="button" class="oculto-impresion close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Se imprimio </strong>El Resibo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class = "row" id="VerPagoModalBody">

                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class=" oculto-impresion btn btn-success" id="SubmitImprimir">Imprimir</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="EditpagoModal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Modal</h5>
                <button type="button" class="oculto-impresion close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Se actualizo </strong>El Resibo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class = "row" id="EditPagoModalBody">

                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class=" oculto-impresion btn btn-success" id="Subtmitupdate">Actualizar</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Delete User Modal -->
<div class="modal" id="DeleteUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Elimianr Usuario</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Se eleimino </strong>Correctamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h4>Esta seguro que desea eleiminar este usuario</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeletePagoForm">ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!--page-loader-->
<div class="page-loader d-none">
    <div class="loader">
        <span class="dot dot_1"></span>
        <span class="dot dot_2"></span>
        <span class="dot dot_3"></span>
        <span class="dot dot_4"></span>
    </div>
</div>


@section('js')
    <!-- dataTables  -->
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <!-- bootstrap dataTables  -->
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.fixedHeader.min.js') }}"></script>

    <script>
        $(function(){

            jQuery('#cedula').keypress(function(tecla){
                var regex = new RegExp("^[a-zA-Z0-9]+$");
                var key = String.fromCharCode(!tecla.charCode ? tecla.which : tecla.charCode);
                if (!regex.test(key)) {
                    tecla.preventDefault();
                    return false;
                }
            });

            $('#data_table').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                order: [ [0, 'desc'] ],
                "processing": true,
                "serverSide": true,
                "fixedHeader": {
                    "headerOffset": $('.main-header').outerHeight()
                },
                "ajax": {
                    url: "{{ route('pago.table') }}",
                },
                "columns":[
                    { "data": "id" },
                    { "data": "nombre" },
                    { "data": "apellido" },
                    { "data": "cedula" },
                    { "data": "articulo" },
                    { "data": "abona" },
                    { "data": "prima" },
                    { "data": "saldo" },
                    { "data": "fecha" },
                    {  data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $('.modelClose').on('click', function(){
                $('.alert-success').hide();
                $('#VerPagoModal').hide();
            });

            let id;
            $('body').on('click', '#getVerPagoData', function(e) {
                e.preventDefault();
                $('.page-loader').removeClass('d-none');
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                id = $(this).data('id');
                $.ajax({
                    url: "pagos/"+id,
                    method: 'GET',
                    success: function(result) {
                        $('.page-loader').addClass('d-none');
                        $('#VerPagoModalBody').html(result.html);
                        $('#VerPagoModal').show();
                    }
                });
            });            
            
            $('#SubmitImprimir').on('click', function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
                $.ajax({
                    method: 'POST',
                    data: {
                        id:id
                    },
                    url: "impresion",
                    success: function(result) {
                        $('.page-loader').addClass('d-none');
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('#data_table').DataTable().ajax.reload();
                        location.reload();
                       
                    },
                    error: function (xhr, status){
                        if (xhr.status === 422){
                            $('.page-loader').addClass('d-none');
                            $.each(xhr.responseJSON.error, function(key, value) {
                                $('.alert-danger').html('');
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                            });
                        }
                    }
                });
            });

            $('.modelClose').on('click', function(){
                $('.alert-success').hide();
                $('#EditpagoModal').hide();
            });

            let edit_id;
            $('body').on('click','#EditarPagoModal', function(e){

                e.preventDefault();
                $('.page-loader').removeClass('d-none');
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                edit_id = $(this).data('id');
                $.ajax({
                    url: "pagos/"+edit_id+"/edit",
                    method: 'GET',
                    success: function(result) {
                        $('.page-loader').addClass('d-none');
                        $('#EditPagoModalBody').html(result.html);
                        $('#EditpagoModal').show();
                    }
                })
               
            });

            // Update user Ajax request.
            $('#Subtmitupdate').click(function (e) {
                e.preventDefault();
                $('.page-loader').removeClass('d-none');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let dolar = 0;
                if( $('#dolar').prop('checked') ) {
                    dolar = 1;
                }

                $.ajax({
                    url: "pagos/"+edit_id,                    
                    method: 'PUT',
                    data: {
                        nombre: $('#nombre').val(),
                        apellido: $('#apellido').val(),
                        cedula: $('#cedula').val(),
                        articulo : $('#articulo').val(),
                        tipo : $('#tipo').val(),
                        pago : $('#pago').val(),
                        saldo : $('#saldo').val(),
                        dolar : dolar,
                        id:edit_id
                    },
                    success: function(result) {
                        $('.page-loader').addClass('d-none');
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('#data_table').DataTable().ajax.reload();
                        location.reload();
                    },
                    error: function (xhr, status){
                        if (xhr.status === 422){
                            $('.page-loader').addClass('d-none');
                            $.each(xhr.responseJSON.error, function(key, value) {
                                $('.alert-danger').html('');
                                $('.alert-danger').show();
                                $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                            });
                        }
                    }
                });
            });
            

            /*eliminar usuario*/
            var deleteID;
            $('body').on('click', '#getDeleteId', function(){
                deleteID = $(this).data('id');
            });

                // Delete project Usuario request.
            $('#SubmitDeletePagoForm').click(function (e) {
                e.preventDefault();
                $('.page-loader').removeClass('d-none');
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                var id = deleteID;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "pagos/"+id,
                    method: 'DELETE',
                    success: function(result) {
                        $('.page-loader').addClass('d-none');
                        if(result.error) {
                            $('.alert-danger').html('');
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+result.error+'</li></strong>');
                        }else {
                            $('.alert-danger').hide();
                            $('.alert-success').show();
                            $('#data_table').DataTable().ajax.reload();
                            setTimeout("$('#DeletePagoModal').modal('hide');",5000);
                            //$('#DeleteUserModal').hide();
                            $('.modal-backdrop').remove();
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>

@endsection
