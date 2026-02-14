<?php

namespace App\Http\Controllers\v1\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\LgaResource;
use App\Models\Setup\SetupLga;

class LgaController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['state_id' => 'required|exists:setup_states,state_id',]);
        try {
            $state = SetupLga::where('state_id', $request->state_id)->get();
            $lga = LgaResource::collection($state);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching local governments: ' . $e->getMessage(),
            ], 500);

            if ($state->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No Local government found for this state.',
                ], 404);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'States fetched successfully.',
            'data' => $lga,
        ], 200);
    }
}
