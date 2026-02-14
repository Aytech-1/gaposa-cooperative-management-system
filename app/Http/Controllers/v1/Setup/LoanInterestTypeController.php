<?php

namespace App\Http\Controllers\v1\Setup;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\LoanInterestTypeResource;
use App\Models\Setup\LoanInterestType;


class LoanInterestTypeController extends Controller
{
    public function index()
    {
       try {
           $fetchedLoanInterestTypes = LoanInterestTypeResource::collection(LoanInterestType::all());
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'An error occurred while fetching loan interest types: ' . $e->getMessage(),
           ], 500);
       }        
      return response()->json([
        'success' => true,
        'message' => 'Loan interest types fetched successfully.',
        'data' => $fetchedLoanInterestTypes            
       ], 200);
    }
}
