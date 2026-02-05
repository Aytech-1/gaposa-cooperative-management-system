<?php

namespace App\Models\Admin;

use App\Models\Setup\SetupTitle;
use App\Models\Setup\SetupGender;
use App\Models\Setup\SetupStatus;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;




class Staff extends Authenticatable
{
    use HasRoles, HasApiTokens, Notifiable;
    protected $guard_name = 'admin';
    protected $primaryKey = 'staff_id'; 
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'staff_id',
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
    protected $casts = ['password' => 'hashed', 'last_login_at' => 'datetime'];
    
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

    public function sendPasswordResetNotification($token): void
{
    $this->notify(new ResetPasswordNotification($token));
}
}
