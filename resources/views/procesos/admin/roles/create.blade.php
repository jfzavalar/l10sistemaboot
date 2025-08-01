@extends('layouts.bootstrap5.dashboard.index')

@section('title', 'roles_create')


@section('content_header')
    
@stop

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom flex-wrap">
        <h1 class="h2"><i class="fa-solid fa-users-gear"></i> ROLES Y PERMISOS</h1>
        @include('layouts.bootstrap5.dashboard.toolbar')
    </div>

    <form method="POST" action="{{ route('procesos.admin.roles.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">
                <strong>Nombre del Rol</strong>
            </label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">
                <strong>Permisos:</strong>
            </label>
            <br>
            @foreach ($permissions as $chunk)
                <div class="row mb-2">
                    @foreach ($chunk as $permission)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" id="perm-{{ $permission->id }}">
                                <label class="form-check-label" for="perm-{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('procesos.admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

@stop