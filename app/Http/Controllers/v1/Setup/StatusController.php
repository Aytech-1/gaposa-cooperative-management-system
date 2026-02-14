<?php

namespace App\Http\Controllers\v1\Setup;

use App\Models\Setup\SetupStatus;

use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\StatusResource;

class StatusController extends Controller
{
    public function index()
    {try {
        $fetchStatus =  StatusResource::collection(SetupStatus::all());
    } catch (\Exception $e) {
        return response()->json([   
            'success' => false,
            'message' => 'An error occurred while fetching statuses: ' . $e->getMessage(),
        ], 500);
    }
       return response()->json([
            'success' => true,'message' => 'Statuses fetched successfully.',
            'data' => $fetchStatus            
        ], 200);
    }
}
