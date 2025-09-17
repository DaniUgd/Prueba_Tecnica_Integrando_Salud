@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Menú Principal</h1>

    <div class="list-group">
        <a href="{{ route('pacientes.listar') }}" class="list-group-item list-group-item-action">
            Gestión de Pacientes
        </a>
        <a href="{{ route('tipos-pet.listar') }}" class="list-group-item list-group-item-action">
            Gestión de Tipos de Pet
        </a>
    </div>
</div>
@endsection