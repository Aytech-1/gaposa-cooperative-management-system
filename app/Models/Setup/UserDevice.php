<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    //
    protected $fillable = [
        'user_id',
        'device_id',
        'device_type',
        'verified_at',
    ];
}
