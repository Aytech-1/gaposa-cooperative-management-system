<?php

namespace App\Http\Controllers\v1\Setup;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\PaymentChannelTypeResource;
use App\Models\Setup\PaymentChannelType;


class PaymentChannelTypeController extends Controller
{
    public function index()
    {
       try {
           $fetchedPaymentChannelTypes = PaymentChannelTypeResource::collection(PaymentChannelType::all());
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'An error occurred while fetching payment channel types: ' . $e->getMessage(),
           ], 500);
       }        
      return response()->json([
        'success' => true,
        'message' => 'Payment channel types fetched successfully.',
        'data' => $fetchedPaymentChannelTypes            
       ], 200);
    }
}
