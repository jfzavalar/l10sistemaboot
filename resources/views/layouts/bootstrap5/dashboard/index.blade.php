<!DOCTYPE html>
  <html lang="es" data-bs-theme="light">
    <head>
      
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Astro v5.9.2">

      <title>
        @yield('title')
      </title>

      <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

      <!-- Bootstrap CSS -->
      <link href="{{ asset('bootstrap5/assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
      <!-- sweetalert2 CSS -->
      <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.min.css" rel="stylesheet">
      <!-- Font Awesome CDN -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
      @yield('css')
      
      <meta name="theme-color" content="#712cf9">

      <!-- Custom styles -->
      <link href="{{ asset('bootstrap5/dashboard/dashboard.css') }}" rel="stylesheet">

      <style>
        /* Inline styles agrupadas */
        .bd-placeholder-img { font-size: 1.125rem; text-anchor: middle; user-select: none; }
        @media (min-width: 768px) {
          .bd-placeholder-img-lg { font-size: 3.5rem; }
        }
        .b-example-divider {
          width: 100%; height: 3rem;
          background-color: rgba(0,0,0,.1);
          border: solid rgba(0,0,0,.15);
          border-width: 1px 0;
          box-shadow: inset 0 .5em 1.5em rgba(0,0,0,.1), inset 0 .125em .5em rgba(0,0,0,.15);
        }
        /* Botón modo oscuro/claro */
        .btn-bd-primary {
          --bd-violet-bg: #712cf9;
          --bd-violet-rgb: 112.520718,44.062154,249.437846;
          --bs-btn-font-weight: 600;
          --bs-btn-color: var(--bs-white);
          --bs-btn-bg: var(--bd-violet-bg);
          --bs-btn-border-color: var(--bd-violet-bg);
          --bs-btn-hover-bg: #6528e0;
          --bs-btn-active-bg: #5a23c8;
        }
        .bd-mode-toggle { z-index: 1500; }
        .bd-mode-toggle .bi { width: 1em; height: 1em; }

        .btn-naranja {
            background-color: #ff8800;
            color: white;
        }

        .btn-azul-oscuro {
            background-color: #003366;
            color: white;
        }

        .btn-verde-lima {
            background-color: #00cc66;
            color: white;
        }

        .btn-outline-naranja {
            color: #ff8800;
            border: 1px solid #ff8800;
            background-color: transparent;
        }

        .btn-outline-naranja:hover {
            background-color: #ff8800;
            color: white;
        }

        .btn-outline-azul-oscuro {
            color: #003366;
            border: 1px solid #003366;
            background-color: transparent;
        }

        .btn-outline-azul-oscuro:hover {
            background-color: #003366;
            color: white;
        }

        .btn-outline-verde-lima {
            color: #00cc66;
            border: 1px solid #00cc66;
            background-color: transparent;
        }

        .btn-outline-verde-lima:hover {
            background-color: #00cc66;
            color: white;
        }
      </style>

      <!-- Color mode script -->
      <script src="{{ asset('bootstrap5/assets/js/color-modes.js') }}"></script>

      @livewireStyles

    </head>


    <body>
      <!-- Sprite SVG hidden -->
      <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <!-- Aquí irían todos los <symbol> SVG agrupados -->
      </svg>

      <!-- Theme toggle dropdown -->
      {{-- <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
                id="bd-theme" type="button" data-bs-toggle="dropdown"
                aria-label="Toggle theme (auto)">
          <svg class="bi my-1 theme-icon-active"><use href="#circle-half"></use></svg>
          <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
          <!-- Light / Dark / Auto options -->
          <li><button class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
            <svg class="bi me-2 opacity-50"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none"><use href="#check2"></use></svg>
          </button></li>
          <li><button class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
            <svg class="bi me-2 opacity-50"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none"><use href="#check2"></use></svg>
          </button></li>
          <li><button class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
            <svg class="bi me-2 opacity-50"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none"><use href="#check2"></use></svg>
          </button></li>
        </ul>
      </div> --}}


      <!-- Navbar -->
      <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow">
        @include('layouts/bootstrap5/dashboard/navbar')

      </header>


      <div class="container-fluid">
        <div class="row">
          <!-- Sidebar/offcanvas -->
          @include('layouts/bootstrap5/dashboard/sidebar')

          <!-- Main content -->
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('content')
          </main>
        </div>
      </div>
      

      <!-- JS scripts al final para optimización -->
      {{-- <script src="{{ asset('bootstrap5/assets/dist/js/bootstrap.bundle.min.js') }}"></script> --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

      {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" crossorigin="anonymous"></script> --}}
      <script src="{{ asset('bootstrap5/dashboard/dashboard.js') }}"></script>
      <!-- sweetalert2 CSS -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js"></script>
      
      @yield('js')

      @livewireScripts
      
    </body>

  </html>
<!DOCTYPE html>