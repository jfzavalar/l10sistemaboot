@extends('layouts.bootstrap5.dashboard.index')

@section('title', 'Personal')


@section('content_header')
    
@stop



@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom flex-wrap">
        <h1 class="h2"><i class="fa-solid fa-users-rectangle"></i> Administración - Personal</h1>
        @include('layouts.bootstrap5.dashboard.toolbar')
    </div>

    @livewire('administracion.personal')
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

    {{-- Cerrar modal despues de enviar correo --}}
    <script>
        window.addEventListener('cerrar-enviar-modal',()=>{
            const modal = bootstrap.Modal.getInstance(document.getElementById('enviar-correo-Modal'));
            if (modal){
                modal.hide();
            }

            // Alerta
            Swal.fire({
                title: "Los datos se enviaron correctamente!",
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

    {{-- Limpiar input file --}}
    <script>
        window.addEventListener('reset-pdf-input', () => {
            document.getElementById('input-pdf').value = '';
        });
    </script>

    {{-- Cerrar modal de cargar PDF --}}
    <script>
        window.addEventListener('cerrar-modal-pdf', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('pdf-cargar-Modal'));
            if (modal) modal.hide();
        });
    </script>
@stop