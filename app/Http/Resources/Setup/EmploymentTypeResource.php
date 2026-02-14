<?php

namespace App\Http\Resources\Setup;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmploymentTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'employmentTypeId' => $this->employment_type_id,
            'employmentTypeName' => $this->employment_type_name,
        ];
    }
}
