<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Setup\LoanInterestType;

class LoanInterestTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'FLAT_RATE',
            'REDUCING_BALANCE',
            'COMPOUND',
        ];

        foreach ($types as $type) {
            LoanInterestType::firstOrCreate([
                'loan_interest_type_name' => $type,
            ]);
        }
    }
}
