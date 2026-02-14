<?php

namespace App\Http\Controllers\v1\Setup;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\EmploymentTypeResource;
use App\Models\Setup\EmployementType;


class EmployementTypeController extends Controller
{
    public function index()
    {
       try {
           $fetchedEmploymentTypes =  EmploymentTypeResource::collection(EmployementType::all());
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'An error occurred while fetching employement types: ' . $e->getMessage(),
           ], 500);
       }        
      return response()->json([
        'success' => true,
        'message' => 'Employement types fetched successfully.',
        'data' => $fetchedEmploymentTypes           
       ], 200);
    }
}
