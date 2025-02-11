@extends('layouts.app')

@section('title', 'Editar Apartamento')

@section('content')
<div class="container">
    <h1>Editar Apartamento</h1>

    <form action="{{ route('apartments.update', $apartment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $apartment->address) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ciudad</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $apartment->city) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Código Postal</label>
            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $apartment->postal_code) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio de Alquiler</label>
            <input type="number" step="0.01" name="rented_price" class="form-control" value="{{ old('rented_price', $apartment->rented_price) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="rented" class="form-control">
                <option value="1" {{ $apartment->rented ? 'selected' : '' }}>Alquilado</option>
                <option value="0" {{ !$apartment->rented ? 'selected' : '' }}>Disponible</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            @if($apartment->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $apartment->photo) }}" class="img-thumbnail" style="max-width: 200px">
                </div>
            @endif
            <input type="file" name="photo" class="form-control">
            <small class="text-muted">Deja vacío si no quieres cambiar la foto.</small>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('apartments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection