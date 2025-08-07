<div>
    <div class="row mt-3">
        <div class="col-xl-6">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" colspan="2" class="text-center">Instalación de Tokens</th>
                        {{-- <th scope="col"></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sumaTotalAsignados = 0;
                        $sumaTotalDevueltos = 0;
                    @endphp

                    @forelse ($totales_asignados as $tactivos)
                        <tr class="align-middle" style="font-size: 12px;">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <th style="white-space: nowrap;">{{ $tactivos->created_user }}</th>
                            <td>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <div class="input-group input-group-sm">
                                        <button class="input-group-text bg-success text-white">
                                            <i class="fa-solid fa-check me-2"></i>Asignados
                                        </button>
                                        <input type="text" class="form-control text-end" value="{{ $tactivos->total_asignados }}" readonly>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <button class="input-group-text bg-danger text-white">
                                            <i class="fa-solid fa-triangle-exclamation me-2"></i>Devueltos
                                        </button>
                                        <input type="text" class="form-control text-end" value="{{ $tactivos->total_devueltos }}" readonly>
                                    </div>
                                </div>
                            </td>

                            @php
                                $sumaTotalAsignados += $tactivos->total_asignados;
                                $sumaTotalDevueltos += $tactivos->total_devueltos;
                            @endphp
                        </tr>
                    @empty
                        <tr class="align-middle"><td colspan="3">Sin registros.</td></tr>
                    @endforelse

                    {{-- Fila resumen final --}}
                    <tr class="table-secondary align-middle">
                        <th></th>
                        <td style="font-size: 12px;"><strong>TOTALES GENERALES:</strong></td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="input-group input-group-sm">
                                    <button class="input-group-text bg-success text-white">
                                        <i class="fa-solid fa-check me-2"></i>Asignados
                                    </button>
                                    <input type="text" class="form-control fw-bold text-end" value="{{ $sumaTotalAsignados }}" readonly>
                                </div>
                                <div class="input-group input-group-sm">
                                    <button class="input-group-text bg-danger text-white">
                                        <i class="fa-solid fa-triangle-exclamation me-2"></i>Devueltos
                                    </button>
                                    <input type="text" class="form-control fw-bold text-end" value="{{ $sumaTotalDevueltos }}" readonly>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xl-6">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="alert alert-primary" role="alert">
                        <h5 class="card-title">
                            Total Tokens
                        </h5>
                        <h1><i class="fa-solid fa-chart-simple text-primary"></i> {{ $lista_activos->total() }}</h1>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="alert alert-success" role="alert">
                        <h5 class="card-title">
                            Actas Firmadas
                        </h5>
                        <h1><i class="fa-solid fa-file-signature text-success"></i> {{ $conteo_rutas->con_ruta }}</h1>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-4">
                    <div class="alert alert-danger" role="alert">
                        <h5 class="card-title">
                            Actas sin Firmar
                        </h5>
                        <h1><i class="fa-solid fa-signature text-danger"></i> {{ $conteo_rutas->sin_ruta }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form>
        <div class="row">
            <div class="col-12">
                <div class="input-group mt-3 mb-3">
                    <input type="text" class="form-control" placeholder="Buscar por DNI o Datos del Personal" wire:model="searchindex">
                    @can('procesos.informatica.tokens.create')
                        <button type="button" class="btn btn-primary" wire:click="nuevo" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                            <i class="fa-solid fa-file"></i> Nuevo Registro
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover table-sm small align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">DNI</th>
                    <th scope="col">DATOS</th>
                    <th scope="col">SEDE</th>
                    {{-- <th scope="col">LOCAL</th> --}}
                    <th scope="col">DEPENDENCIA</th>
                    <th scope="col">CARGO</th>
                    <th scope="col">TOKEN</th>
                    <th scope="col">EXPIRACION</th>
                    <th scope="col">ASIGNACIÓN</th>
                    <th scope="col">
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lista_activos as $activo)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $activo->dni }}</td>
                        <td>{{ $activo->datos }}</td>
                        <td>{{ $activo->sede }}</td>
                        {{-- <td></td> --}}
                        <td>{{ $activo->dependencia }}</td>
                        <td>{{ $activo->cargo }}</td>
                        <td>{{ $activo->codtoken }}</td>
                        <td>{{ $activo->fecha_expiracion }}</td>
                        <td>
                            @if ($activo->asignacion == "ASIGNACION" || $activo->asignacion == "REASIGNACION")
                                <span class="badge rounded-pill text-bg-success">{{ $activo->asignacion }}</span>
                            @else
                                <span class="badge rounded-pill text-bg-danger">{{ $activo->asignacion }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($activo->asignacion == "ASIGNACION" || $activo->asignacion == "REASIGNACION")
                                <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="$emit('confirmarDevolucion', {{ $activo->id }})">
                                    <i class="fas fa-exchange-alt"></i> Devolver
                                </button>
                            @endif
                            @if ($activo->asignacion == "DEVOLUCION")
                                <button type="button" class="btn btn-outline-danger btn-sm" wire:click="reasignar1({{ $activo->id }})" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                    <i class="fas fa-exchange-alt"></i> Reasignar
                                </button>
                            @endif 
                        </td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="btn-group" role="group">
                                    @can('procesos.informatica.tokens.create')
                                        <button type="button" class="btn btn-outline-primary btn-sm" wire:click="editar({{ $activo->id }})" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </button>
                                    @endcan
                                    {{-- <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver">
                                        <i class="fa-solid fa-eye"></i> Ver
                                    </button> --}}
                                    {{-- <a type="button" href="{{ route('pdf.informatica.token-acta', $activo->id) }}" target="_blank" class="btn btn-outline-dark btn-sm">
                                        <i class="fa-solid fa-print"></i> Acta
                                    </a> --}}
                                    {{-- <button type="button" class="btn btn-outline-dark btn-sm" wire:click="exportarPDF({{ $activo->id }})">
                                        <i class="fa-solid fa-file-arrow-down"></i> DescargarPDF
                                    </button> --}}
                                    {{-- <button type="button" class="btn btn-outline-success btn-sm" wire:click="cargarPDF1({{ $activo->id }})" data-bs-toggle="modal" data-bs-target="#pdf-cargar-Modal">
                                        <i class="fa-solid fa-file-pdf"></i> CargarPDF
                                    </button> --}}
                                    {{-- <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#pdf-cargar-Modal">
                                        <i class="fa-solid fa-file-pdf"></i> Firmado
                                    </button> --}}
                                    <button type="button" class="btn btn-outline-info btn-sm" wire:click="$set('codtoken','{{ $activo->codtoken }}')" data-bs-toggle="modal" data-bs-target="#historial-Modal">
                                        <i class="fa-solid fa-timeline"></i> Historial
                                    </button>     
                                    @can('procesos.informatica.tokens.destroy')
                                        <button type="button" class="btn btn-outline-danger btn-sm" wire:click="$emit('confirmarEliminacion', {{ $activo->id }})">
                                            <i class="fa-solid fa-trash-can"></i> Eliminar
                                        </button>
                                    @endcan                                
                                </div>
                            </div>       
                        </td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="btn-group" role="group">                                        
                                    @if ($activo->actaruta)
                                        <a href="{{ asset($activo->actaruta) }}" target="_blank" class="btn btn-outline-warning btn-sm">
                                            <i class="fa-solid fa-file-pdf"></i> Firmado
                                        </a>
                                    @endif
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
                                    <div class="input-group mb-3">
                                        <button type="button" class="btn {{ $color_boton }}" data-bs-toggle="modal" data-bs-target="#personal-buscar-Modal">
                                            <i class="fa-brands fa-searchengin"></i> Buscar
                                        </button>
                                        <input type="text" class="form-control bg-light" value="{{ $dni . ' - ' . $datos . ' - ' . $cargo . ' - ' . $regimen }}" readonly>
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label">Apellidos y Nombres</label>
                                        <input type="text" class="form-control bg-light" wire:model="datos" readonly required>
                                    </div>
                                    <div class="row g-3 mt-3">
                                        <div class="col-lg-4 col-sm-12">
                                            <label class="form-label">DNI</label>
                                            <input type="text" class="form-control bg-light" wire:model="dni" readonly required>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <label class="form-label">Cargo</label>
                                            <input type="text" class="form-control bg-light" wire:model="cargo" readonly required>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <label class="form-label">Régimen</label>
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
                                            <label class="form-label">Sede</label>
                                            <div class="input-group mb-3">
                                                <button type="button" class="btn {{ $color_boton }}" data-bs-toggle="modal" data-bs-target="#sede-buscar-Modal">
                                                    <i class="fa-brands fa-searchengin"></i> Buscar
                                                </button>
                                                <input type="text" class="form-control bg-light" wire:model="sede" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label">Dependencia</label>
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
                                            <label class="form-label">Correo Institucional</label>
                                            <input type="text" class="form-control bg-light" wire:model="correo_institucional" readonly>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <label class="form-label">Celular Institucional</label>
                                            <input type="text" class="form-control bg-light" wire:model="cel_institucional" readonly>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <label class="form-label">Correo Personal</label>
                                            <input type="text" class="form-control bg-light" wire:model="correo_personal" readonly>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <label class="form-label">Celular Personal</label>
                                            <input type="text" class="form-control bg-light" wire:model="cel_personal" readonly>
                                        </div>
                                    </div>
                                    <div class="row g-3 mt-3">
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label">Fecha Expiración</label>
                                            <input type="date" class="form-control" wire:model="fecha_expiracion">
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label">Observación</label>
                                            <input type="text" class="form-control" wire:model="observacion">
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

    @include('livewire.partials.modaldependenciabuscar')
    @include('livewire.partials.modalenviarcorreo')
    @include('livewire.partials.modalhistorial')
    @include('livewire.partials.modalpersonalbuscar')
    @include('livewire.partials.modalpdfcargar')
    @include('livewire.partials.modalsedebuscar')
    
</div>
