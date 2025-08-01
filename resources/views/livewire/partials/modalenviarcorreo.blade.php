<!-- Modal enviar correo -->
<div wire:ignore.self class="modal fade" id="enviar-correo-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="">
                <div class="modal-header bg-dark-subtle">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <i class="fa-solid fa-envelopes-bulk"></i> ENVIAR FORMATOS
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-xl-12 border-start-1">
                            <fieldset class="border p-4 rounded mb-2">
                                {{-- <legend class="float-none w-outo px-3">Datos del Personal</legend> --}}
                                <br><label class="form-label fw-bold">DNI:</label> {{ $dni }}
                                <br><label class="form-label fw-bold">Datos:</label> {{ $datos }}
                                <br><label class="form-label fw-bold">CARGO:</label> {{ $cargo }}
                                <br><label class="form-label fw-bold">REGIMEN:</label> {{ $regimen }}
                                <br><label class="form-label fw-bold">SEDE:</label> {{ $sede }}
                                <br><label class="form-label fw-bold">DEPENDENCIA:</label> {{ $dependencia }}
                                <br><label class="form-label fw-bold">CORREO INSTITUCIONAL:</label> {{ $correo_institucional }}
                                <br><label class="form-label fw-bold">CELULAR INSTITUCIONAL:</label> {{ $cel_institucional }}
                                <br><label class="form-label fw-bold">CORREO PERSONAL:</label> {{ $correo_personal }}
                                <br><label class="form-label fw-bold">CELULAR PERSONAL:</label>  {{ $cel_personal }}
                            </fieldset>
                        </div>    
                    </div>          
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="enviar_correo2" wire:loading.attr="disabled" wire:target="enviar_correo2" class="btn btn-outline-primary btn-sm" >
                        <i class="fa-solid fa-envelope"></i> 
                        <br>
                        <strong>
                            <span wire:loading.remove wire:target="enviar_correo2">Enviar formatos a:</span>
                            {{-- <span wire:loading wire:target="enviar_correo2">Enviando...</span> --}}
                            <div class="spinner-border text-primary" wire:loading wire:target="enviar_correo2" role="status">
                                <span class="visually-hidden">Enviando a: </span>
                            </div>
                        </strong>
                        {{ $correo_institucional }}
                    </button>
                    <button type="button" wire:click="enviar_correo3" wire:loading.attr="disabled" wire:target="enviar_correo3" class="btn btn-outline-info btn-sm" >
                        <i class="fa-solid fa-envelope"></i> 
                        <br>
                        <strong>
                            <span wire:loading.remove wire:target="enviar_correo3">Enviar usuario y contraseña a:</span>
                            {{-- <span wire:loading wire:target="enviar_correo2">Enviando...</span> --}}
                            <div class="spinner-border text-primary" wire:loading wire:target="enviar_correo3" role="status">
                                <span class="visually-hidden">Enviando a: </span>
                            </div>
                        </strong>
                        {{ $correo_institucional }}
                    </button>
                    {{-- <a href="{{ route('probar-mail') }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fa-solid fa-envelope"></i>
                        <br>Enviar
                    </a>    --}}
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="fa-solid fa-door-closed"></i>
                        <br>Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>