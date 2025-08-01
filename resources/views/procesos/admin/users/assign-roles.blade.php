@extends('layouts.bootstrap5.dashboard.index')

@section('title', 'roles_permisos')


@section('content_header')
    
@stop

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom flex-wrap">
        <h1 class="h2"><i class="fa-solid fa-users"></i> ASIGNAR ROLES</h1>
        @include('layouts.bootstrap5.dashboard.toolbar')
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('procesos.admin.users.roles.update', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            @foreach($roles->chunk(2) as $chunk)
                <div class="row">
                    @foreach($chunk as $role)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                    class="form-check-input"
                                    {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $role->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Roles</button>
    </form>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop


@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop