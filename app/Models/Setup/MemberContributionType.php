<?php

namespace App\Models\Setup;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\MemberContribution;

class MemberContributionType extends Model
{
    protected $primaryKey = 'member_contribution_type_id';

    protected $fillable = ['member_contribution_type_name'];

    public function contributions()
    {
        return $this->hasMany(MemberContribution::class, 'member_contribution_type_id');
    }
}

