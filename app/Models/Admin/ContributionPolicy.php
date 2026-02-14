<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class ContributionPolicy extends Model
{
    protected $primaryKey = 'contribution_policy_id';
    protected $fillable = [
        'compulsory_amount',
        'minimum_amount',
        'allow_voluntary',
        'allow_increment',
        'effective_date',
        'created_by',
    ];


}


