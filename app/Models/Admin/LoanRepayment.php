<?php

namespace App\Models\Admin;
use Predis\Response\Status;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setup\PaymentChannelType;

class LoanRepayment extends Model
{
    protected $primaryKey = 'loan_repayment_id';

    protected $fillable = [
        'loan_id',
        'amount',
        'interest_amount',
        'principal_amount',
        'repayment_date',
        'status_id',
        'payment_reference',
        'payment_channel_type_id',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id', 'loan_id');
    }

    public function paymentChannel()
    {
        return $this->belongsTo(PaymentChannelType::class, 'payment_channel_type_id', 'payment_channel_type_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'status_id');
    }
}
