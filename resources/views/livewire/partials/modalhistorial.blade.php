<!-- Modal Historial -->
<div wire:ignore.self class="modal fade" id="historial-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form>
                <div class="modal-header bg-secondary-subtle">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <i class="fa-solid fa-timeline"></i> Historial
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form>
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
                    </form> --}}
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover small">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">DATOS</th>
                                    <th scope="col">SEDE</th>
                                    {{-- <th scope="col">LOCAL</th> --}}
                                    <th scope="col">DEPENDENCIA</th>
                                    {{-- <th scope="col">DESPACHO</th> --}}
                                    <th scope="col">CARGO</th>
                                    <th scope="col">ASIGNACIÓN</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lista_historial as $historial)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $historial->dni }}</td>
                                        <td>{{ $historial->datos }}</td>
                                        <td>{{ $historial->sede }}</td>
                                        {{-- <td></td> --}}
                                        <td>{{ $historial->dependencia }}</td>
                                        <td>{{ $historial->cargo }}</td>
                                        <td>
                                            @if ($historial->asignacion == "ASIGNACION" || $historial->asignacion == "REASIGNACION")
                                                <span class="badge rounded-pill text-bg-success">{{ $historial->asignacion }}</span>
                                            @else
                                                <span class="badge rounded-pill text-bg-danger">{{ $historial->asignacion }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <div class="btn-group" role="group">
                                                    <a type="button" href="{{ route('pdf.informatica.token-acta', $historial->id) }}" target="_blank" class="btn btn-outline-dark btn-sm">
                                                        <i class="fa-solid fa-print"></i> Acta
                                                    </a>
                                                    <button type="button" class="btn btn-outline-success btn-sm" wire:click="cargarPDF1({{ $historial->id }})" data-bs-toggle="modal" data-bs-target="#pdf-cargar-Modal">
                                                        <i class="fa-solid fa-file-pdf"></i> CargarPDF
                                                    </button>
                                                    @if ($historial->actaruta)
                                                        <a href="{{ asset($historial->actaruta) }}" target="_blank" class="btn btn-outline-warning btn-sm">
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
                                    <strong>Total de registros:</strong> {{ $lista_historial->total() }}
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    {{ $lista_historial->links() }}
                                </div>
                            </div>
                        </tfoot>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" wire:click="personal_cerrar" data-bs-dismiss="modal">
                        <i class="fa-solid fa-door-closed"></i>
                        <br>Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>