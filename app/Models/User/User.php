<?php

namespace App\Models\User;

use App\Models\Setup\SetupTitle;
use App\Models\Setup\SetupGender;
use App\Models\Setup\SetupStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    protected $primaryKey = 'user_id'; 
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'title_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender_id',
        'email',
        'mobile_number',
        'home_address',
        'password',
        'passport',
        'created_by',
        'updated_by',
        'last_login_at',
        
    ]; 
    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed',];


    public function status()
    {
        return $this->belongsTo(SetupStatus::class, 'status_id', 'status_id');
    }

    public function gender()
    {
        return $this->belongsTo(SetupGender::class, 'gender_id', 'gender_id');
    }

    public function title()
    {
        return $this->belongsTo(SetupTitle::class, 'title_id', 'title_id');
    }

    const DEFAULT_PASSPORT = 'default.png';
}
