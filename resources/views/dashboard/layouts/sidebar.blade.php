<!-- Sidebar -->
<div id="sidebar-container" class="bg-primary oculto-impresion">
    <div class="logo">
        <h4 class="text-light font-weight-bold mb-0">Variedades Cindy</h4>
    </div>
    <div class="menu">
        <a href="{{ route('home')}} " class="d-block text-light p-3 border-0"><i class="icon ion-md-apps lead mr-2"></i>
            Inicio</a>
        <a href="{{ route('pagos.index')}}" class="d-block text-light p-3 border-0"><i class="icon ion-md-apps lead mr-2"></i>
            Pagos</a>
        @if(Auth::user()->is_admin)
        <a href="{{ route('users.index') }}" class="d-block text-light p-3 border-0"><i class="icon ion-md-people lead mr-2"></i>Usuarios</a>
        @endif
        <!--a href="#" class="d-block text-light p-3 border-0"><i class="icon ion-md-stats lead mr-2"></i>
            Estadísticas</a>
        <a href="#" class="d-block text-light p-3 border-0"><i class="icon ion-md-person lead mr-2"></i>
            Perfil</a>
        <a href="#" class="d-block text-light p-3 border-0"> <i class="icon ion-md-settings lead mr-2"></i>
            Configuración</a-->
    </div>
</div>
<!-- Fin sidebar -->
