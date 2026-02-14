<?php

namespace App\Http\Controllers\v1\Setup;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\CountryResource;
use App\Models\Setup\SetupCountry;


class CountryController extends Controller
{
    public function index()
    {
       try {
           $fetchedCountries =  CountryResource::collection(SetupCountry::all());
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'An error occurred while fetching countries: ' . $e->getMessage(),
           ], 500);
       }        
      return response()->json([
        'success' => true,
        'message' => 'Countries fetched successfully.',
        'data' => $fetchedCountries            
       ], 200);
    }

}
