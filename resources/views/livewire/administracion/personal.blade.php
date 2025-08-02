<div>
    {{-- <div class="row">
        <div class="col-xl-8">
            <table class="table table-sm small">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th class="text-center" scope="col">USUARIOS</th>
                        <th class="text-center" scope="col">FORMATOS</th>
                        <th class="text-center" scope="col">USUARIOS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($totales_asignados as $tactivos)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $tactivos->created_user }}</th>
                            <td>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <div class="input-group input-group-sm mb-3">
                                        <button class="input-group-text bg-success text-white" id="inputGroup-sizing-sm">
                                            <i class="fa-solid fa-check me-2"></i>Enviados
                                        </button>
                                        <input type="text" class="form-control" value="{{ $tactivos->total_enviados }}" readonly>
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <button class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">
                                            <i class="fa-solid fa-triangle-exclamation me-2"></i>Pendientes
                                        </button>
                                        <input type="text" class="form-control" value="{{ $tactivos->total_pendientes }}" readonly>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <div class="input-group input-group-sm mb-3">
                                        <button class="input-group-text bg-success text-white" id="inputGroup-sizing-sm">
                                            <i class="fa-solid fa-check me-2"></i>Enviados
                                        </button>
                                        <input type="text" class="form-control" value="{{ $tactivos->total_enviados_u }}" readonly>
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <button class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">
                                            <i class="fa-solid fa-triangle-exclamation me-2"></i>Pendientes
                                        </button>
                                        <input type="text" class="form-control" value="{{ $tactivos->total_pendientes_u }}" readonly>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="col-xl-4">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fa-solid fa-spider"></i> Total
                            </h5>
                            <p class="card-text">
                                <h1>{{ $lista_activos->total() }}</h1>
                            </p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fa-solid fa-spider"></i> Total
                            </h5>
                            <p class="card-text">
                                <h1>{{ $lista_activos->total() }}</h1>
                            </p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- @can('procesos.informatica.spijweb.destroy') --}}
        <ul class="nav nav-pills mt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="index-tab" data-bs-toggle="tab" data-bs-target="#index-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="true">
                    Activos
                </button>
            </li>
        
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#inactivos-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">
                    Inactivos
                </button>
            </li>
        </ul>
    {{-- @endcan --}}

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane show active" id="index-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            <form>
                <div class="row">
                    <div class="col-12">
                        <div class="input-group mt-3 mb-3">
                            <input type="text" class="form-control" placeholder="Buscar por DNI o Datos del Personal" wire:model="search">
                            {{-- @can('procesos.informatica.spijweb.create') --}}
                                <button type="button" class="btn btn-primary" wire:click="nuevo" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                    <i class="fa-solid fa-file"></i> Nuevo Registro
                                </button>
                            {{-- @endcan --}}
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover table-sm small align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DNI</th>
                            <th scope="col">DATOS</th>
                            <th scope="col">SEDE</th>
                            {{-- <th scope="col">LOCAL</th> --}}
                            <th scope="col">DEPENDENCIA</th>
                            <th scope="col">CARGO</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lista_activos as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->dni }}</td>
                                <td>{{ $item->datos }}</td>
                                <td>{{ $item->sede }}</td>
                                {{-- <td></td> --}}
                                <td>{{ $item->dependencia }}</td>
                                <td>{{ $item->cargo }}</td>
                                {{-- <td>
                                    @if ($item->estado_formato === "ENVIADO")
                                        <span class="badge rounded-pill text-bg-success">ENVIADO</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">PENDIENTE</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->estado_userpass === "ENVIADO")
                                        <span class="badge rounded-pill text-bg-success">ENVIADO</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">PENDIENTE</span>
                                    @endif
                                </td> --}}
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <div class="btn-group" role="group">
                                            @can('procesos.informatica.spijweb.edit')
                                                <button type="button" class="btn btn-outline-primary btn-sm" wire:click="editar({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                                </button>
                                            @endcan
                                            {{-- <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver">
                                                <i class="fa-solid fa-eye"></i> Ver
                                            </button> --}}
                                            {{-- <a type="button" href="{{ route('pdf.informatica.spijweb-acta', $item->id) }}" target="_blank" class="btn btn-outline-dark btn-sm">
                                                <i class="fa-solid fa-print"></i>VerActa
                                            </a> --}}
                                            {{-- <button type="button" class="btn btn-outline-dark btn-sm" wire:click="exportarPDF({{ $item->id }})">
                                                <i class="fa-solid fa-file-arrow-down"></i> DescargarPDF
                                            </button> --}}
                                            {{-- <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#pdf-cargar-Modal">
                                                <i class="fa-solid fa-file-pdf"></i>DescargarActa
                                            </button> --}}
                                            {{-- <button type="button" class="btn btn-outline-dark btn-sm" wire:click="enviar_correo1({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#enviar-correo-Modal">
                                                <i class="fa-solid fa-truck-fast"></i> EnviarActa
                                            </button> --}}
                                            {{-- <button type="button" class="btn btn-outline-dark btn-sm" wire:click="enviar_correo1({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#enviar-correo-usuario-Modal">
                                                <i class="fa-solid fa-user-tag"></i> EnviarUsuario
                                            </button> --}}

                                            @can('procesos.informatica.spijweb.destroy')
                                                <button type="button" class="btn btn-outline-danger btn-sm" wire:click="$emit('confirmarEliminacion', {{ $item->id }})">
                                                    <i class="fa-solid fa-trash-can"></i> Eliminar
                                                </button>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <div class="btn-group" role="group">
                                            {{-- <button type="button" class="btn btn-outline-info btn-sm" wire:click="cargarPDF1({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#pdf-cargar-Modal">
                                                <i class="fa-solid fa-file-pdf"></i> CargarActaFirmada
                                            </button> --}}
                                            {{-- @if ($item->actaruta)
                                                <a href="{{ asset($item->actaruta) }}" target="_blank" class="btn btn-outline-warning btn-sm">
                                                    <i class="fa-solid fa-file-pdf"></i> Firmado
                                                </a>
                                            @endif --}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                No existen registros
                            </div>
                        @endforelse
                    </tbody>
                </table>
                <tfoot>
                    {{-- Links de paginación --}}
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>Total de registros:</strong> {{ $lista_activos->total() }}
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            {{ $lista_activos->links() }}
                        </div>
                    </div>
                </tfoot>
            </div>
        </div>
        <div class="tab-pane fade fade" id="inactivos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <form>
                <div class="row">
                    <div class="col-12">
                        <div class="input-group mt-3 mb-3">
                            <input type="text" class="form-control" placeholder="Buscar por DNI o Datos del Personal" aria-label="Recipient’s username" aria-describedby="button-addon2">
                            {{-- <button type="button" class="btn btn-outline-primary" wire:click="nuevo" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                <i class="fa-solid fa-file"></i> Nuevo
                            </button> --}}
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover table-sm small align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DNI</th>
                            <th scope="col">DATOS</th>
                            <th scope="col">SEDE</th>
                            {{-- <th scope="col">LOCAL</th> --}}
                            <th scope="col">DEPENDENCIA</th>
                            <th scope="col">CARGO</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lista_inactivos as $item2)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item2->dni }}</td>
                                <td>{{ $item2->datos }}</td>
                                <td>{{ $item2->sede }}</td>
                                <td></td>
                                <td>{{ $item2->dependencia }}</td>
                                <td>{{ $item2->cargo }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <div class="btn-group" role="group">
                                            @can('procesos.informatica.spijweb.destroy')
                                                <button type="button" class="btn btn-outline-danger btn-sm" wire:click="$emit('confirmarReactivacion', {{ $item2->id }})">
                                                    <i class="fa-solid fa-trash-can-arrow-up"></i> Reactivar
                                                </button>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                No existen registros
                            </div>
                        @endforelse
                    </tbody>
                </table>
                <tfoot>
                    {{-- Links de paginación --}}
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>Total de registros:</strong> {{ $lista_inactivos->total() }}
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            {{ $lista_inactivos->links() }}
                        </div>
                    </div>
                </tfoot>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="new-edit-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form wire:submit.prevent={{ $guardar_actualizar }}>
                    <div class="modal-header {{ $color_modal_header }}">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            <i class="fa-solid fa-file"></i> {{ $nuevo_editar }} REGISTRO
                        </h1>
                        <button type="button" class="btn-close" wire:click="cerrar_nuevo" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <fieldset class="border p-4 rounded mb-4">
                                    {{-- <legend class="float-none w-outo px-3">Formulario</legend> --}}
                                    {{-- <div class="input-group mb-3">
                                        <button type="button" class="btn {{ $color_boton }}" data-bs-toggle="modal" data-bs-target="#personal-buscar-Modal">
                                            <i class="fa-brands fa-searchengin"></i> Buscar
                                        </button>
                                        <input type="text" class="form-control bg-light" value="{{ $dni . ' - ' . $datos . ' - ' . $cargo . ' - ' . $regimen }}" readonly>
                                    </div> --}}
                                    <div class="col-sm-12">
                                        <label class="form-label"><strong>Apellidos y Nombres</strong></label>
                                        <input type="text" class="form-control" wire:model="datos" required>
                                    </div>
                                    <div class="row g-3 mt-3">
                                        <div class="col-lg-4 col-sm-12">
                                            <label class="form-label"><strong>DNI</strong></label>
                                            <input type="text" class="form-control" wire:model="dni" required>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <label class="form-label"><strong>Cargo</strong></label>
                                            <div class="input-group mb-3">
                                                <button type="button" class="btn {{ $color_boton }}" data-bs-toggle="modal" data-bs-target="#cargo-buscar-Modal">
                                                    <i class="fa-brands fa-searchengin"></i> Buscar
                                                </button>
                                                <input type="text" class="form-control bg-light" wire:model="cargo" readonly required>
                                            </div>
                                            {{-- <select class="form-select" wire:model="cargo" required>
                                                <option value="">Seleccionar...</option>
                                                <option value="FISCAL ADJUNTO PROVINCIAL">FISCAL ADJUNTO PROVINCIAL</option>
                                                <option value="FISCAL ADJUNTO SUPERIOR">FISCAL ADJUNTO SUPERIOR</option>
                                                <option value="FISCAL PROVINCIAL">FISCAL PROVINCIAL</option>
                                                <option value="FISCAL SUPERIOR">FISCAL SUPERIOR</option>
                                            </select> --}}
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <label class="form-label"><strong>Régimen</strong></label>
                                            <div class="form-group">
                                                <input type="radio" class="btn-check" name="options-outlined" value="DL.276" wire:model="regimen" id="success-outlined" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="success-outlined">D.L.276</label>

                                                <input type="radio" class="btn-check" name="options-outlined" value="DL.728" wire:model="regimen" id="danger-outlined" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="danger-outlined">D.L.728</label>

                                                <input type="radio" class="btn-check" name="options-outlined" value="CAS" wire:model="regimen" id="info-outlined" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="info-outlined">CAS</label>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row g-3 mt-3">
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label"><strong>Sede</strong></label>
                                            <div class="input-group mb-3">
                                                <button type="button" class="btn {{ $color_boton }}" data-bs-toggle="modal" data-bs-target="#sede-buscar-Modal">
                                                    <i class="fa-brands fa-searchengin"></i> Buscar
                                                </button>
                                                <input type="text" class="form-control bg-light" wire:model="sede" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label"><strong>Dependencia</strong></label>
                                            <div class="input-group mb-3">
                                                <button type="button" class="btn {{ $color_boton }}" data-bs-toggle="modal" data-bs-target="#dependencia-buscar-Modal">
                                                    <i class="fa-brands fa-searchengin"></i> Buscar
                                                </button>
                                                <input type="text" class="form-control bg-light" wire:model="dependencia" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 mt-3">
                                        <div class="col-lg-3 col-sm-12">
                                            <label class="form-label"><strong>Correo Institucional</strong></label>
                                            <input type="email" class="form-control" wire:model="correo_institucional">
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <label class="form-label"><strong>Celular Institucional</strong></label>
                                            <input type="text" class="form-control" wire:model="cel_institucional">
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <label class="form-label"><strong>Correo Personal</strong></label>
                                            <input type="email" class="form-control" wire:model="correo_personal">
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <label class="form-label"><strong>Celular Personal</strong></label>
                                            <input type="text" class="form-control" wire:model="cel_personal">
                                        </div>
                                    </div>
                                </fieldset>
                            </div> 
                            {{-- <div class="col-xl-4 border-start-1">
                                <fieldset class="border p-4 rounded mb-4">
                                    <legend class="float-none w-outo px-3">Datos del Personal</legend>
                                    <div class="input-group mb-3">
                                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#personal-buscar-Modal">
                                            <i class="fa-solid fa-copy"></i> Copiar
                                        </button>
                                        <input type="text" class="form-control" value="{{ $dni . ' - ' . $datos . ' - ' . $cargo . ' - ' . $regimen }}">
                                    </div>
                                    <br><label class="form-label">DNI:</label> {{ $dni }}
                                    <br><label class="form-label">Datos:</label> {{ $datos }}
                                    <br><label class="form-label">CARGO:</label> {{ $cargo }}
                                    <br><label class="form-label">REGIMEN:</label> {{ $regimen }}
                                    <br><label class="form-label">SEDE:</label> {{ $sede }}
                                    <br><label class="form-label">DEPENDENCIA:</label> {{ $dependencia }}
                                    <br><label class="form-label">CORREO INSTITUCIONAL:</label> {{ $correo_institucional }}
                                    <br><label class="form-label">CELULAR INSTITUCIONAL:</label> {{ $cel_institucional }}
                                    <br><label class="form-label">CORREO PERSONAL:</label> {{ $correo_personal }}
                                    <br><label class="form-label">CELULAR PERSONAL:</label>  {{ $cel_personal }}
                                </fieldset>
                            </div>     --}}
                        </div>         
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn {{ $color_boton }}">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <br>Guardar
                        </button>
                        <button type="button" class="btn btn-outline-secondary" wire:click="cerrar_nuevo" data-bs-dismiss="modal">
                            <i class="fa-solid fa-door-closed"></i>
                            <br>Cerrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('livewire.partials.modalcargobuscar')
    @include('livewire.partials.modaldependenciabuscar')
    {{-- @include('livewire.partials.modalenviarcorreo')
    @include('livewire.partials.modalenviarcorreousuario') --}}
    {{-- @include('livewire.partials.modalpersonalbuscar') --}}
    {{-- @include('livewire.partials.modalpdfcargar') --}}
    @include('livewire.partials.modalsedebuscar')
    
</div>

