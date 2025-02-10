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
}