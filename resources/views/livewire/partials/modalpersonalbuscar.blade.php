<!-- Modal buscar personal -->
<div wire:ignore.self class="modal fade" id="personal-buscar-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="">
                <div class="modal-header bg-secondary-subtle">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <i class="fa-brands fa-searchengin"></i> BUSCAR PERSONAL
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#new-edit-Modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mt-3 mb-3">
                                    <input type="text" class="form-control" placeholder="Buscar por DNI o Datos del Personal" wire:model="searchpersonal">
                                    {{-- <button class="btn btn-outline-primary" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                        <i class="fa-solid fa-file"></i> Nuevo
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover small">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">DATOS</th>
                                    <th scope="col">SEDE</th>
                                    <th scope="col">LOCAL</th>
                                    <th scope="col">DEPENDENCIA</th>
                                    <th scope="col">DESPACHO</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lista_personal as $personal)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td>{{ $personal->id }}</td>
                                        <td>{{ $personal->dni }}</td>
                                        <td>{{ $personal->datos }}</td>
                                        <td>{{ $personal->sede }}</td>
                                        <td></td>
                                        <td>{{ $personal->dependencia }}</td>
                                        <td></td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-outline-success btn-sm" wire:click="personal_agregar({{ $personal->id }})" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                                                        <i class="fa-solid fa-share-from-square"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                        <tfoot>
                            {{-- Links de paginación --}}
                            {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                {{ $lista_personal->links('') }}
                            </div> --}}
                        </tfoot>
                        
                    </div>          
                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-outline-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <br>Guardar
                    </button> --}}
                    <button type="button" class="btn btn-outline-secondary" wire:click="personal_cerrar" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                        <i class="fa-solid fa-door-closed"></i>
                        <br>Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>