<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom oculto-impresion">
<div class="container">

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
    <li class="nav-item dropdown">
    <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <!--img src="#" class="img-fluid rounded-circle avatar mr-2"
        alt="https://generated.photos/" /-->
        {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        
        <a class="dropdown-item" href="#">Mi perfil</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    </li>
</ul>
</div>
</div>
</nav>
<!-- Fin Navbar -->