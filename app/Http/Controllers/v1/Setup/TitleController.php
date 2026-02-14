<?php

namespace App\Http\Controllers\v1\Setup;

use App\Models\Setup\SetupTitle;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\TitleResource;

class TitleController extends Controller
{
    public function index()
    {try {
        $fetchedTitles =  TitleResource::collection(SetupTitle::all());
    } catch (\Exception $e) {   
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while fetching titles: ' . $e->getMessage(),
        ], 500);
    }
       return response()->json([
            'success' => true,'message' => 'Titles fetched successfully.',
            'data' => $fetchedTitles            
        ], 200);
    }
}
