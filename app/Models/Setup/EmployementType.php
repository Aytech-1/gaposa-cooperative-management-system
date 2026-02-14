<?php

namespace App\Models\Setup;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class EmployementType extends Model
{
    protected $primaryKey = 'employement_type_id';

    protected $fillable = ['employement_type_name'];

    public function users()
    {
        return $this->hasMany(User::class, 'employement_type_id');
    }
}

