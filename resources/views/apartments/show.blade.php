@extends('layouts.app')

@section('title', 'Detalles del Apartamento')

@section('content')
<div class="container">
    <h1>Detalles del Apartamento</h1>

    <div class="card">
        <div class="card-body">
            @if($apartment->photo)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $apartment->photo) }}" class="img-fluid" style="max-width: 400px">
                </div>
            @endif

            <dl class="row">
                <dt class="col-sm-3">Dirección</dt>
                <dd class="col-sm-9">{{ $apartment->address }}</dd>

                <dt class="col-sm-3">Ciudad</dt>
                <dd class="col-sm-9">{{ $apartment->city }}</dd>

                <dt class="col-sm-3">Código Postal</dt>
                <dd class="col-sm-9">{{ $apartment->postal_code }}</dd>

                <dt class="col-sm-3">Precio de Alquiler</dt>
                <dd class="col-sm-9">{{ $apartment->rented_price }}€</dd>

                <dt class="col-sm-3">Estado</dt>
                <dd class="col-sm-9">{{ $apartment->rented ? 'Alquilado' : 'Disponible' }}</dd>
            </dl>

            <a href="{{ route('apartments.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-warning">Editar</a>

            <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este apartamento?')">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection