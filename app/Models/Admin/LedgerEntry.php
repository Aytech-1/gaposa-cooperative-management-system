<?php

namespace App\Models\Admin;
use App\Models\Setup\LedgerType;
use Illuminate\Database\Eloquent\Model;


class LedgerEntry extends Model
{
    protected $primaryKey = 'ledger_entry_id';

    protected $fillable = [
        'ledger_type_id',
        'wallet_id',
        'amount',
        'balance_before',
        'balance_after',
        'created_by',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'wallet_id');
    }

    public function ledgerType()
    {
        return $this->belongsTo(LedgerType::class, 'ledger_type_id', 'ledger_type_id');
    }
}
