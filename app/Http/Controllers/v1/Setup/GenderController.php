<?php

namespace App\Http\Controllers\v1\Setup;

use App\Models\Setup\SetupGender;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\GenderResource;

class GenderController extends Controller
{
    public function index()
    {
        try {
       $fetchedGenders =  GenderResource::collection(SetupGender::all());
    } catch (\Exception $e) {   
        return response()->json([

            'success' => false,
            'message' => 'An error occurred while fetching genders: ' . $e->getMessage(),
        ], 500);
    }
       return response()->json([
            'success' => true,'message' => 'Genders fetched successfully.',
            'data' => $fetchedGenders            
        ], 200);
    }
}
    