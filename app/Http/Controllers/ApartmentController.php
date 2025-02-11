<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Storage;

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
            $apartments = Apartment::orderBy('city')->orderBy('address')->get();
            return view('apartments.index', compact('apartments'));
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
        $apartment = Apartment::findOrFail($id);
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
    public function updatePlatform(Request $request, $id)
    {
        $validated = $request->validate([
            'platform_id' => ['required', 'integer', 'exists:platforms,id'],
            'premium' => ['required', 'boolean'],
        ]);

        $apartment = Apartment::findOrFail($id);

        $existingRelation = $apartment->platforms()->where('platform_id', $validated['platform_id'])->first();

        if ($existingRelation) {
          
            $apartment->platforms()->updateExistingPivot($validated['platform_id'], ['premium' => $validated['premium']]);
        } else {
           
            $apartment->platforms()->attach($validated['platform_id'], [
                'register_date' => now(),
                'premium' => $validated['premium'],
            ]);
        }
        return response()->json($apartment->load(['platforms:id,name'])->makeHidden(['user_id']));
    }
    public function getRentedApartments(Request $request)
    {
        
        $validated = $request->validate([
            'rented' => ['required']
        ]);
    
        $rented = filter_var($validated['rented'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    
        if ($rented === null) {
            return response()->json(['message' => 'El parámetro rented debe ser true o false'], 400);
        }
    
        $apartments = Apartment::where('rented', $rented)
            ->with(['user:id,email']) 
            ->get();
    
        return response()->json($apartments);
    }
    public function getHighPriceApartments()
{
    $apartments = Apartment::where('rented_price', '>', 1000)
        ->with([
            'user:id,email' 
        ])
        ->get();

    return response()->json($apartments);
}
    public function indexWeb()
    {
        $apartments = Apartment::orderBy('city')->orderBy('address')->get();
        return view('apartments.index', compact('apartments')); 
    }

    public function createWeb()
{
    return view('apartments.create');
}

public function storeWeb(Request $request)
{
    $validated = $request->validate([
        'address' => ['required', 'string', 'max:100'],
        'city' => ['required', 'string'],
        'postal_code' => ['required', 'string', 'size:5'],
        'rented_price' => ['nullable', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        'rented' => ['required', 'boolean'],
        'photo' => ['nullable', 'image', 'max:2048'],
    ]);

    $validated['user_id'] = $request->user()->id ?? 1;
; 

    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')->store('apartments', 'public');
    }

    $apartment = Apartment::create($validated);

    return redirect()->route('apartments.show', $apartment->id);
}
    public function editWeb($id)
{
    $apartment = Apartment::findOrFail($id);
    return view('apartments.edit', compact('apartment'));
}

public function updateWeb(Request $request, $id)
{
    $apartment = Apartment::findOrFail($id);

    $validated = $request->validate([
        'address' => ['required', 'string', 'max:100'],
        'city' => ['required', 'string'],
        'postal_code' => ['required', 'string', 'size:5'],
        'rented_price' => ['nullable', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        'rented' => ['required', 'boolean'],
        'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
    ]);

    if ($request->hasFile('photo')) {
        if ($apartment->photo && Storage::disk('public')->exists($apartment->photo)) {
            Storage::disk('public')->delete($apartment->photo);
        }
        $validated['photo'] = $request->file('photo')->store('apartments', 'public');
    }

    $apartment->update($validated);

    return redirect()->route('apartments.show', $apartment->id)
        ->with('success', 'Apartamento actualizado correctamente');
}
public function showWeb($id)
{
    $apartment = Apartment::findOrFail($id);
    
    return view('apartments.show', compact('apartment'));
}
public function destroyWeb($id)
{
    $apartment = Apartment::findOrFail($id);

    if ($apartment->photo && Storage::disk('public')->exists($apartment->photo)) {
        Storage::disk('public')->delete($apartment->photo);
    }

    $apartment->delete();

    return redirect()->route('apartments.index')->with('success', 'Apartamento eliminado correctamente.');
}
}