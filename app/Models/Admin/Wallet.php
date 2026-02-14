<?php

namespace App\Models\Admin;

use App\Models\User\User;
use App\Models\Setup\SetupStatus;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $primaryKey = 'wallet_id';
    protected $fillable = [
        'user_id',
        'balance',
        'locked_balance',
        'status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function ledgerEntries()
    {
        return $this->hasMany(LedgerEntry::class, 'wallet_id', 'wallet_id');
    }

    public function status()
    {
        return $this->belongsTo(SetupStatus::class, 'status_id', 'status_id');
    }
}
