@extends('layouts.bootstrap5.dashboard.index')

@section('title', 'roles_permisos')


@section('content_header')
    
@stop

@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom flex-wrap">
        <h1 class="h2"><i class="fa-solid fa-users-gear"></i> ROLES Y PERMISOS</h1>
        @include('layouts.bootstrap5.dashboard.toolbar')
    </div>

    <a href="{{ route('procesos.admin.roles.create') }}" class="btn btn-primary mb-3">
        <i class="fa-solid fa-file"></i> Crear nuevo rol
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover small">
            <thead class="table-primary">
                <tr>
                    <th scope="col">ROL</th>
                    <th scope="col">PERMISOS</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{!! $role->permissions->pluck('name')->implode('<br>') !!}</td>
                        <td>
                            <a href="{{ route('procesos.admin.roles.edit', $role->id) }}" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i><br>Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop


@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop