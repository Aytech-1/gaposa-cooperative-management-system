<?php

namespace App\Http\Resources\Setup;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberContributionTypeResource  extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'memberContributionTypeId' => $this->member_contribution_type_id,
            'memberContributionTypeName' => $this->member_contribution_type_name,
        ];
    }
}
