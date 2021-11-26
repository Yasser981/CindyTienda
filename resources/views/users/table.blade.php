@section('style')
    <!-- data table css -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fixedHeader.bootstrap.min.css') }}">
@stop

<div class="card-body table-responsive">
    <table id="data_table" class="table table-bordered table-striped table-hover dataTable w-100">
        <thead>
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
        </thead>
    </table>
</div>
<div class="modal" id="EditProjectModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Editar usuario</h5>
                <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Se actualizo </strong>El Usuario.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="EditProyectModalBody">

                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitEditUserForm">Actualizar</button>
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
                <button type="button" class="btn btn-danger" id="SubmitDeleteUserForm">ok</button>
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
                    url: "{{ route('user.table') }}",
                },
                "columns":[
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "is_admin" },
                    {  data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $('.modelClose').on('click', function(){
                $('.alert-success').hide();
                $('#EditProjectModal').hide();
            });

            let id;
            $('body').on('click', '#getEditUserData', function(e) {
                e.preventDefault();
                $('.page-loader').removeClass('d-none');
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                id = $(this).data('id');
                $.ajax({
                    url: "users/"+id+"/edit",
                    method: 'GET',
                    success: function(result) {
                        $('.page-loader').addClass('d-none');
                        $('#EditProyectModalBody').html(result.html);
                        $('#EditProjectModal').show();
                    }
                });
            });

            // Update user Ajax request.
            $('#SubmitEditUserForm').click(function (e) {
                e.preventDefault();
                $('.page-loader').removeClass('d-none');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "users/"+id,
                    method: 'PUT',
                    data: {
                        nombre: $('#nombre').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        admin : $('#rol').val(),
                        id:id
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
            $('#SubmitDeleteUserForm').click(function (e) {
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
                    url: "users/"+id,
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
                            setTimeout("$('#DeleteUserModal').modal('hide');",5000);
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