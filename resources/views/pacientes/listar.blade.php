@extends('layouts.app')

@section('title', 'Listado de Pacientes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Listado de Pacientes</h1>
    <a href="{{ route('pacientes.crear') }}" class="btn btn-success">+ Nuevo Paciente</a>
</div>

{{-- Mensaje de éxito --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Mensaje de error --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Filtros --}}
<form method="GET" action="{{ route('pacientes.listar') }}" class="row g-3 mb-3">
    <div class="col-md-8">
        <input type="text" name="search" class="form-control" placeholder="Buscar por DNI o Apellido" value="{{ request('search') }}">
    </div>
    <div class="col-md-4 d-flex">
        <button type="submit" class="btn btn-primary me-2">Buscar</button>
        <a href="{{ route('pacientes.listar') }}" class="btn btn-secondary">Limpiar</a>
    </div>
</form>

{{-- Tabla de pacientes --}}
<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">DNI</th>
            <th scope="col">Sexo</th>
            <th scope="col">Fecha de nacimiento</th>
            <th scope="col" class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pacientes as $paciente)
            <tr>
                <td>{{ $paciente->nombre }}</td>
                <td>{{ $paciente->apellido }}</td>
                <td>{{ $paciente->dni }}</td>
                <td>{{ $paciente->sexo }}</td>
                <td>{{ $paciente->fecha_nacimiento }}</td>
                <td class="text-center">
                    <a href="{{route('pacientes.editar', $paciente->id) }}" class="btn btn-sm btn-primary">Editar</a>
                    <a href="{{route('pacientes.tratamientos.listar', $paciente->id)}}"class="btn btn-sm btn-info"> Ver tratamientos</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No se encontraron pacientes</td>
            </tr>
        @endforelse
    </tbody>
</table>
<a href="{{ route('inicio') }}" class="btn btn-secondary">← Volver a inicio</a>
@endsection