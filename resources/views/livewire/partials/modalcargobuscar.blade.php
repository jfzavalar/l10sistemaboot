<!-- Modal buscar sede -->
<div wire:ignore.self class="modal fade" id="cargo-buscar-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="">
                <div class="modal-header bg-secondary-subtle">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <i class="fa-brands fa-searchengin"></i> BUSCAR CARGO
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#new-edit-Modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mt-3 mb-3">
                                    <input type="text" class="form-control" placeholder="Buscar cargo" wire:model="searchcargo">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover small">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">CARGO</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lista_cargo as $cargo)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cargo->cargo }}</td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-outline-success btn-sm" wire:click="cargo_agregar('{{ $cargo->cargo }}')" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
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

                        </tfoot>
                        
                    </div>          
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" wire:click="personal_cerrar" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#new-edit-Modal">
                        <i class="fa-solid fa-door-closed"></i>
                        <br>Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>