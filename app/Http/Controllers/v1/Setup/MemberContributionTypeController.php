<?php

namespace App\Http\Controllers\v1\Setup;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setup\MemberContributionTypeResource;
use App\Models\Setup\MemberContributionType;


class MemberContributionTypeController extends Controller
{
    public function index()
    {
       try {
           $fetchedMemberContributionTypes = MemberContributionTypeResource::collection(MemberContributionType::all());
       } catch (\Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'An error occurred while fetching member contribution types: ' . $e->getMessage(),
           ], 500);
       }        
      return response()->json([
        'success' => true,
        'message' => 'Member contribution types fetched successfully.',
        'data' => $fetchedMemberContributionTypes            
       ], 200);
    }
}
