@extends('layouts.app')

@section('title', 'Crear Apartamento')

@section('content')
<div class="container">
    <h1>Crear Nuevo Apartamento</h1>

    <form action="{{ route('apartments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ciudad</label>
            <input type="text" name="city" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Código Postal</label>
            <input type="text" name="postal_code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio de Alquiler</label>
            <input type="number" step="0.01" name="rented_price" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="rented" class="form-control">
                <option value="1">Alquilado</option>
                <option value="0">Disponible</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('apartments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection