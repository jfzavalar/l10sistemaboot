<nav class="sidebar col-md-3 col-lg-2 p-0 bg-dark text-white border-end min-vh-100">
    <div class="offcanvas-md offcanvas-end bg-dark text-white" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menú</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    {{-- <a class="nav-link text-white" href="{{ route('dashboard') }}"> --}}
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-primary text-white fw-bold rounded-pill' : 'text-white' }}" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-house"></i> Dashboard
                    </a>
                </li>
                @can('procesos.admin.users.index')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('procesos.admin.users.index') ? 'active bg-primary text-white fw-bold rounded-pill' : 'text-white' }}" href="{{ route('procesos.admin.users.index') }}">
                            <i class="fa-solid fa-users"></i> Usuarios
                        </a>
                    </li>
                @endcan
                @can('procesos.admin.roles.index')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('procesos.admin.roles.index') ? 'active bg-primary text-white fw-bold rounded-pill' : 'text-white' }}" href="{{ route('procesos.admin.roles.index') }}">
                            <i class="fa-solid fa-users-gear"></i> Roles
                        </a>
                    </li>
                @endcan
                @can('procesos.admin.permissions.index')
                    <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa-solid fa-users-line"></i> Permisos</a></li>
                @endcan
            </ul>

            <h6 class="sidebar-heading px-3 mt-4 mb-1 text-uppercase text-white">
                ADMINISTRACIÓN
            </h6>
            <ul class="nav flex-column mb-auto">
                @can('procesos.administracion.personal.index')
                    <li>
                        <a class="nav-link {{ request()->routeIs('procesos.administracion.personal.index') ? 'active bg-primary text-white fw-bold rounded-pill' : 'text-white' }}" href="{{ route('procesos.administracion.personal.index') }}">
                            <i class="fa-solid fa-users-rectangle"></i> Personal
                        </a>
                    </li>
                @endcan
            </ul>

            <h6 class="sidebar-heading px-3 mt-4 mb-1 text-uppercase text-white">
                INFORMÁTICA
            </h6>
            <ul class="nav flex-column mb-auto">
                @can('procesos.informatica.firmaspcs.index')
                    <li>
                        <a class="nav-link {{ request()->routeIs('procesos.informatica.firmaspcs.index') ? 'active bg-primary text-white fw-bold rounded-pill' : 'text-white' }}" href="{{ route('procesos.informatica.firmaspcs.index') }}">
                            <i class="fa-solid fa-desktop"></i> Firma Pc
                        </a>
                    </li>
                @endcan
                @can('procesos.informatica.tokens.index')
                    <li>
                    <a class="nav-link {{ request()->routeIs('procesos.informatica.tokens.index') ? 'active bg-primary text-white fw-bold rounded-pill' : 'text-white' }}" href="{{ route('procesos.informatica.tokens.index') }}">
                        <i class="fa-brands fa-usb"></i> Firma Token
                    </a>
                </li>
                @endcan
                @can('procesos.informatica.spijweb.index')
                    <li>
                        <a class="nav-link {{ request()->routeIs('procesos.informatica.spijweb.index') ? 'active bg-primary text-white fw-bold rounded-pill' : 'text-white' }}" href="{{ route('procesos.informatica.spijweb.index') }}">
                            <i class="fa-solid fa-users-viewfinder"></i> SPIJ
                        </a>
                    </li>
                @endcan
            </ul>
            <hr class="my-3 text-white">
            <ul class="nav flex-column">
                <li>
                    <a class="nav-link text-white" href="#">
                        <i class="fa-solid fa-gear"></i> Configuración
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-power-off"></i> Cerrar sesión
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>