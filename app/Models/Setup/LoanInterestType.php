<?php

namespace App\Models\Setup;

use App\Models\User\User;
use App\Models\Admin\LoanPolicy;
use Illuminate\Database\Eloquent\Model;

class LoanInterestType extends Model
{
    protected $primaryKey = 'loan_interest_type_id';

    protected $fillable = ['loan_interest_type_name'];

    public function loanPolicies()
    {
        return $this->hasMany(LoanPolicy::class, 'loan_interest_type_id');
    }
}


