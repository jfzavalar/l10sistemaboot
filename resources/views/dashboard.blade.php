@extends('layouts.bootstrap5.dashboard.index')

@section('title', 'Dashboard')


@section('content_header')
    
@stop



@section('content')
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom flex-wrap">
        <h1 class="h2"><i class="fa-solid fa-desktop"></i> DASHBOARD</h1>
        @include('layouts.bootstrap5.dashboard.toolbar')
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            {{-- <a class="navbar-brand" href="#">SIS</a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-file"></i> Archivo
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-file-pen"></i> Edición
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <svg aria-label="Placeholder: Third slide" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" height="400" preserveAspectRatio="xMidYMid slice" role="img" width="800" xmlns="http://www.w3.org/2000/svg"><title>Placeholder</title><rect width="100%" height="100%" fill="#e5e5e5"></rect><text x="50%" y="50%" fill="#999" dy=".3em">Third slide</text></svg>
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                <svg aria-label="Placeholder: Third slide" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" height="400" preserveAspectRatio="xMidYMid slice" role="img" width="800" xmlns="http://www.w3.org/2000/svg"><title>Placeholder</title><rect width="100%" height="100%" fill="#e5e5e5"></rect><text x="50%" y="50%" fill="#999" dy=".3em">Third slide</text></svg>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                <svg aria-label="Placeholder: Third slide" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" height="400" preserveAspectRatio="xMidYMid slice" role="img" width="800" xmlns="http://www.w3.org/2000/svg"><title>Placeholder</title><rect width="100%" height="100%" fill="#e5e5e5"></rect><text x="50%" y="50%" fill="#999" dy=".3em">Third slide</text></svg>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


@stop


@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop


@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
