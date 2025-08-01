<div class="btn-toolbar mb-2 mb-md-0">
    {{-- <div class="input-group mb-3">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->datos }} <i class="fa-solid fa-sliders"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-power-off"></i> Cerrar Sesión
                </a>
            </li>
        </ul>
    </div> --}}
    <div class="btn-group">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->datos }} <i class="fa-solid fa-sliders"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><button class="dropdown-item" type="button">Action</button></li>
            <li><button class="dropdown-item" type="button">Another action</button></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-power-off"></i> Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>
</div>