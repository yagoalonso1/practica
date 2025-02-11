@extends('layouts.app')

@section('title', 'Lista de Apartamentos')

@section('content')
<div class="container">
    <h1>Lista de Apartamentos</h1>
    
    <a href="{{ route('apartments.create') }}" class="btn btn-success mb-3">Crear Apartamento</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Precio Alquiler</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apartments as $apartment)
                <tr>
                    <td>{{ $apartment->id }}</td>
                    <td>{{ $apartment->address }}</td>
                    <td>{{ $apartment->city }}</td>
                    <td>{{ $apartment->rented_price }}€</td>
                    <td>
                        <a href="{{ route('apartments.show', $apartment->id) }}" class="btn btn-info btn-sm">Mostrar</a>
                        <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este apartamento?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection