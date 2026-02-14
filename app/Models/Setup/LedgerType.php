<?php

namespace App\Models\Setup;

use App\Models\Admin\LedgerEntry;
use Illuminate\Database\Eloquent\Model;

class LedgerType extends Model
{
    protected $primaryKey = 'ledger_type_id';

    protected $fillable = ['ledger_type_name'];

    public function entries()
    {
        return $this->hasMany(LedgerEntry::class, 'ledger_type_id');
    }
}


