<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;

class LocationController extends Controller
{
    // province
    public function provinces()
    {
        $provinces = Province::all();

        return response()->json([
            'success' => true,
            'message' => 'List Data Province',
            'data' => $provinces
        ]);
    }

    // city
    public function cities(Request $request, $provinces_id)
    {
        $regencies = City::where('province_id', $provinces_id)->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data City',
            'data' => $regencies
        ]);
    }
}
