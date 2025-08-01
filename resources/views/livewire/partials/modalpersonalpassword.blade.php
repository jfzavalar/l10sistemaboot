<div wire:ignore.self class="modal fade" id="personal-password-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form wire:submit.prevent = guardar_actualizar_password>
                    <div class="modal-header {{ $color_modal_header }}">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            <i class="fa-solid fa-file"></i> {{ $nuevo_editar }} PASSWORD
                        </h1>
                        <button type="button" class="btn-close" wire:click="cerrar_nuevo" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <fieldset class="border p-4 rounded mb-4">
                                    {{-- <legend class="float-none w-outo px-3">Formulario</legend> --}}
                                    <div class="row g-3">
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label">DNI</label>
                                            <input type="text" class="form-control bg-light" wire:model="dni" readonly required>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label">Cargo</label>
                                            <input type="text" class="form-control bg-light" wire:model="datos" readonly required>
                                        </div>
                                    </div>
                                    <div class="row g-3 mt-3">
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" wire:model="password1" required>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label">Repetir contraseña</label>
                                            <input type="password" class="form-control" wire:model="password2" required>
                                        </div>
                                    </div>
                                </fieldset>
                                @if($password1 !== $password2 && $password2 !== null)
                                    <div class="alert alert-danger" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation"></i> Las contraseñas no coinciden.
                                    </div>
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