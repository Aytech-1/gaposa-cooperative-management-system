<?php

namespace App\Http\Resources\Setup;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LedgerTypeResource  extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ledgerTypeId' => $this->ledger_type_id,
            'ledgerTypeName' => $this->ledger_type_name,
        ];
    }
}
