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
}