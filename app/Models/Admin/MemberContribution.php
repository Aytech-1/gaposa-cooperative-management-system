<?php

namespace App\Models\Admin;
use App\Models\User\User;
use Predis\Response\Status;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setup\MemberContributionType;

class MemberContribution extends Model
{
    protected $primaryKey = 'member_contribution_id';

    protected $fillable = [
        'member_contribution_type_id',
        'user_id',
        'amount',
        'contribution_date',
        'month',
        'year',
        'status_id',
        'processed_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(MemberContributionType::class, 'member_contribution_type_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'status_id');
    }
}



