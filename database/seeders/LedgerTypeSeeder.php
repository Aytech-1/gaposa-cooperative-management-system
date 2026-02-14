<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Setup\LedgerType;

class LedgerTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'CONTRIBUTION',
            'TARGET_SAVINGS',
            'LOAN_DISBURSEMENT',
            'LOAN_REPAYMENT',
            'INTEREST_CHARGE',
            'INTEREST_EARNED',
            'WALLET_ADJUSTMENT',
            'PENALTY',
            'REFUND',
        ];

        foreach ($types as $type) {
            LedgerType::firstOrCreate([
                'ledger_type_name' => $type,
            ]);
        }
    }
}
