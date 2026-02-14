<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Setup\MemberContributionType;

class MemberContributionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'MONTHLY_CONTRIBUTION',
            'VOLUNTARY_SAVINGS',
            'SPECIAL_CONTRIBUTION',
            'EMERGENCY_CONTRIBUTION',
            'TARGET_SAVINGS',
        ];

        foreach ($types as $type) {
            MemberContributionType::firstOrCreate([
                'member_contribution_type_name' => $type,
            ]);
        }
    }
}
