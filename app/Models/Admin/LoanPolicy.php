<?php

namespace App\Models\Admin;
use App\Models\Setup\LoanInterestType;
use Illuminate\Database\Eloquent\Model;

class LoanPolicy extends Model
{
    protected $primaryKey = 'loan_policy_id';

    protected $fillable = [
        'loan_multiplier',
        'minimum_amount',
        'maximum_amount',
        'min_duration_months',
        'max_duration_months',
        'interest_rate',
        'loan_interest_type_id',
        'eligibility_months',
        'allow_multiple_loans',
        'created_by',
    ];

    public function interestType()
    {
        return $this->belongsTo(LoanInterestType::class, 'loan_interest_type_id');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'loan_policy_id');
    }
}



