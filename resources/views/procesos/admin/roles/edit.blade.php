@extends('layouts.bootstrap5.dashboard.index')

@section('title', 'roles_create')


@section('content_header')
    
@stop

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom flex-wrap">
        <h1 class="h2"><i class="fa-solid fa-users-gear"></i> ROLES Y PERMISOS</h1>
        @include('layouts.bootstrap5.dashboard.toolbar')
    </div>

    <form action="{{ route('procesos.admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre del rol -->
        <div class="mb-3">
            <label for="name" class="form-label">
                <strong>Nombre del Rol:</strong>
            </label>
            <input type="text" name="name" value="{{ $role->name }}" class="form-control" required>
        </div>

        <!-- Permisos -->
        <div class="mb-3">
            <label for="name" class="form-label">
                <strong>Permisos:</strong>
            </label>
            @foreach ($permissions as $chunk)
                <div class="row mb-2">
                    @foreach ($chunk as $permission)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input 
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission->name }}"
                                    class="form-check-input"
                                    id="perm-{{ $permission->id }}"
                                    {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="perm-{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Botón -->
        <button type="submit" class="btn btn-primary">Actualizar Rol</button>
        <a href="{{ route('procesos.admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

@stop
