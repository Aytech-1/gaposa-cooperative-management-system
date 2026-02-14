<?php

namespace App\Http\Controllers\v1\Setup;

use Illuminate\Http\Request;
use App\Models\Setup\SetupState;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\StateResource;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['country_id' => 'required|exists:setup_countries,country_id',]);
        try {
            $country = SetupState::where('country_id', $request->country_id)->get();
            $States = StateResource::collection($country);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching states: ' . $e->getMessage(),
            ], 500);

            if ($country->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No states found for this country.',
                ], 404);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'States fetched successfully.',
            'data' => $States,
        ], 200);
    }
}