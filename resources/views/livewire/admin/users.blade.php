<div>
    @can('procesos.admin.users.destroy')
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
        </ul>
    @endcan
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane show active" id="index-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            <form>
                <div class="row">
                    <div class="col-12">
                        <div class="input-group mt-3 mb-3">
                            <input type="text" class="form-control" placeholder="Buscar por DNI o Datos del Personal" wire:model="search">
                            <button type="button" class="btn btn-primary" wire:click="nuevo" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                <i class="fa-solid fa-file"></i> Nuevo Registro
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive mt-3">
                <table class="table table-hover table-sm small align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DNI</th>
                            <th scope="col">NOMBRE</th>                    
                            <th scope="col">CORREO</th>
                            <th scope="col">ROL ACTUAL</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lista_activos as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->dni }}</td>
                                <td>{{ $user->datos }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-outline-success btn-sm" wire:click="editar({{ $user->id }})" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                                <i class="fa-solid fa-pen-to-square"></i> Editar
                                            </button>
                                            <button type="button" class="btn btn-outline-warning btn-sm" wire:click="editar({{ $user->id }})" data-bs-toggle="modal" data-bs-target="#personal-password-Modal">
                                                <i class="fa-solid fa-pen-to-square"></i> Password
                                            </button>                 
                                        </div>

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('procesos.admin.users.roles.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fa-solid fa-user-shield"></i> Asignar Roles
                                            </a>
                                            @can('procesos.admin.users.destroy')
                                                <button type="button" class="btn btn-outline-danger btn-sm">
                                                    <i class="fa-solid fa-trash-can"></i> Eliminar
                                                </button>
                                            @endcan                      
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay usuarios registrados.</td>
                            </tr>
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
                            <input type="text" class="form-control" placeholder="Buscar" aria-label="Recipient’s username" aria-describedby="button-addon2">
                            <button type="button" class="btn btn-outline-primary" wire:click="nuevo" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                <i class="fa-solid fa-file"></i> Nuevo
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive mt-3">
                <table class="table table-hover table-sm small align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DNI</th>
                            <th scope="col">NOMBRE</th>                    
                            <th scope="col">CORREO</th>
                            <th scope="col">ROL ACTUAL</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lista_inactivos as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->dni }}</td>
                                <td>{{ $user->datos }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('procesos.admin.users.roles.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fa-solid fa-user-shield"></i> Asignar Roles
                                            </a>
                                            @can('procesos.admin.users.destroy')
                                                <button type="button" class="btn btn-outline-danger btn-sm">
                                                    <i class="fa-solid fa-trash-can"></i> Eliminar
                                                </button>
                                            @endcan                      
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay usuarios registrados.</td>
                            </tr>
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
                                            <input type="text" class="form-control bg-light @error('dni') is-invalid @enderror" wire:model="dni" readonly required>
                                             @error('dni')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                                </fieldset>
                                @if ($guardar_actualizar==="guardar")
                                    <fieldset class="border p-4 rounded">
                                        <legend class="float-none w-outo px-3">Restablecer contraseña</legend>
                                        <div class="row g-3">
                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" wire:model="dni" required>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label">Repetir Password</label>
                                                <input type="password" class="form-control" wire:model="dni" required>
                                            </div>
                                        </div>
                                    </fieldset>
                                @endif
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
    @include('livewire.partials.modalpersonalbuscar')
    @include('livewire.partials.modalpersonalpassword')
    @include('livewire.partials.modalpdfcargar')
    @include('livewire.partials.modalsedebuscar')
    
</div>