@extends('layouts.bootstrap5.dashboard.index')

@section('title', 'roles_permisos')


@section('content_header')
    
@stop

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom flex-wrap">
        <h1 class="h2"><i class="fa-solid fa-users"></i> USUARIOS</h1>
        @include('layouts.bootstrap5.dashboard.toolbar')
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @livewire('admin.users')
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
        window.addEventListener('cerrar-modal-password',()=>{
            const modal = bootstrap.Modal.getInstance(document.getElementById('personal-password-Modal'));
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
@stop