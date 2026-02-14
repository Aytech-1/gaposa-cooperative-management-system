<?php

namespace App\Http\Controllers\v1\Setup;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\LedgerTypeResource;
use App\Models\Setup\LedgerType;


class LedgerTypeController extends Controller
{
    public function index()
    {
       try {
           $fetchedLedgerTypes =  LedgerTypeResource::collection(LedgerType::all());
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'An error occurred while fetching ledger types: ' . $e->getMessage(),
           ], 500);
       }        
      return response()->json([
        'success' => true,
        'message' => 'Ledger types fetched successfully.',
        'data' => $fetchedLedgerTypes            
       ], 200);
    }
}
