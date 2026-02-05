<?php

namespace App\Models\Setup;

use App\Models\User\User;
use App\Models\Admin\Staff;
use Illuminate\Database\Eloquent\Model;

class SetupLogActivity extends Model
{
    protected $fillable = [
        'action',
        'description',
        'performed_by',
        'user_type',
        'device_model',
        'browser_name',
        'ip_address',
    ];
   

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'performed_by', 'staff_id');    
      
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'performed_by', 'user_id');    
      
    }
}
