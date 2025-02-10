<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Symfony\Component\HttpFoundation\Response;

class VerifyApartmentOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $apartmentId = $request->route('id');
        $apartment = Apartment::find($apartmentId);

        if (!$apartment) {
            return response()->json(['message' => 'Apartamento no encontrado'], 404);
        }
        if ($apartment->user_id !== auth()->id()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return $next($request);
    }
}