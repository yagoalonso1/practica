<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
       
        $query = Apartment::query();

        if ($request->has('city')) {
            $city = $request->input('city');
            $query->where('city', 'LIKE', "$city%");
        }

        $apartments = $query->with([
            'user:id,email',  
            'platforms:id,name' 
        ])->get();

        return response()->json($apartments);
    }
    public function show($id)
{
    if (!is_numeric($id)) {
        return response()->json(['message' => 'El ID debe ser un número válido'], 400);
    }
    $apartment = Apartment::with([
        'user:id,email', 
        'platforms:id,name' 
    ])->find($id);

    if (!$apartment) {
        return response()->json(['message' => 'Apartamento no encontrado'], 404);
    }

    return response()->json($apartment);
}
public function store(Request $request)
{
    $validated = $request->validate([
        'address' => ['required', 'string', 'max:100'],
        'city' => ['required', 'string'],
        'postal_code' => ['required', 'string', 'size:5'],
        'rented_price' => ['nullable', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        'rented' => ['required', 'boolean'],
    ]);

    $apartment = $request->user()->apartments()->create($validated);

    return response()->json([
        'message' => 'Apartamento creado correctamente',
        'apartment' => $apartment
    ], 201);
}
public function update(Request $request, $id)
{
    if (!is_numeric($id)) {
        return response()->json(['message' => 'El ID debe ser un número válido'], 400);
    }
    $apartment = Apartment::find($id);
    if (!$apartment) {
        return response()->json(['message' => 'Apartamento no encontrado'], 404);
    }
    if ($apartment->user_id !== auth()->id()) {
        return response()->json(['message' => 'No tienes permiso para actualizar este apartamento'], 403);
    }
     $validated = $request->validate([
        'address' => ['required', 'string', 'max:100'],
        'city' => ['required', 'string'],
        'postal_code' => ['required', 'string', 'size:5'],
        'rented_price' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        'rented' => ['required', 'boolean'],
    ]);

    $apartment->update($validated);

    return response()->json([
        'message' => 'Apartamento actualizado correctamente',
        'apartment' => $apartment
    ]);
}
}