<?php

namespace App\Http\Resources\Setup;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanInterestTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'loanInterestTypeId' => $this->loan_interest_type_id,
            'loanInterestTypeName' => $this->loan_interest_type_name,
        ];
    }
}
