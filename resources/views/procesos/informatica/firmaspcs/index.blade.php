@extends('layouts.bootstrap5.dashboard.index')

@section('title', 'FirmasPC')


@section('content_header')
    
@stop



@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom flex-wrap">
        <h1 class="h2"><i class="fa-solid fa-desktop"></i> Administración de Certificados - PC</h1>
        @include('layouts.bootstrap5.dashboard.toolbar')
    </div>

    @can('procesos.informatica.firmaspcs.destroy')
        <ul class="nav nav-pills mt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="index-tab" data-bs-toggle="tab" data-bs-target="#index-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="true">
                    <i class="fa-solid fa-desktop"></i> PC
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#inactivos-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">
                    <i class="fa-brands fa-usb"></i>  TOKEN
                </button>
        </ul>
    @endcan

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane show active" id="index-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            @livewire('informatica.firmaspcs')
        </div>
        <div class="tab-pane fade fade" id="inactivos-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            
        </div>
    </div>
 
@stop


@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop


@section('js')
    {{-- Cerrar modal despues de guardar --}}
    <script>
        window.addEventListener('cerrar-modal',()=>{
            const modal = bootstrap.Modal.getInstance(document.getElementById('new-edit-Modal'));
            if (modal){
                modal.hide();
            }

            // Alerta
            Swal.fire({
                title: "Los datos se guardaron correctamente!",
                icon: "success",
                draggable: true
            });
        });
    </script>

    {{-- Cancelar operación --}}
    <script>
        window.addEventListener('cancelar-proceso', event => {
            Swal.fire({
                icon: 'error',
                title: "CANCELAR",
                text: "Se canceló la operación",
                footer: ""
            });
        });
    </script>

    {{-- Eliminar Registros --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('confirmarEliminacion', id => {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('eliminar', id);
                        Swal.fire("¡Eliminado!", "El registro ha sido eliminado.", "success");
                    }
                });
            });
        });
    </script>

    {{-- Reactivar Registros --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('confirmarReactivacion', id => {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, reactivar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('reactivar', id);
                        Swal.fire("¡Reactivación!", "El registro ha sido reactivado.", "success");
                    }
                });
            });
        });
    </script>

    {{-- Devolución--}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('confirmarDevolucion', id => {
                Swal.fire({
                    title: "¿Estás seguro?",
                    // text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, devolver",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('devolver2', id);
                        Swal.fire("¡Comunicado!", "Se registró la devolución.", "success");
                    }
                });
            });
        });
    </script>

    {{-- Reasignación--}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('confirmarReasignacion', id => {
                Swal.fire({
                    title: "¿Estás seguro?",
                    // text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, reasignar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('reasignar2', id);
                        Swal.fire("¡Comunicado!", "Se registró la resignación.", "success");
                    }
                });
            });
        });
    </script>

    <script>
        window.addEventListener('cerrar-modal-pdf', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('pdf-cargar-Modal'));
            if (modal) modal.hide();
        });
    </script>
@stop