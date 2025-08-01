<!-- Modal cargar personal -->
<div wire:ignore.self class="modal fade" id="pdf-cargar-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="cargarPDF2">
                <div class="modal-header bg-primary-subtle">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <i class="fa-solid fa-file-pdf"></i> CARGAR PDF
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mt-3 mb-3">
                        <input type="file" class="form-control" id="input-pdf" wire:model="pdf" accept="application/pdf" required>
                        @error('pdf') <span class="text-danger">{{ $message }}</span> @enderror
                        {{-- <label class="input-group-text" for="inputGroupFile02">Upload</label> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <br>Guardar
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-door-closed"></i>
                        <br>Cerrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>