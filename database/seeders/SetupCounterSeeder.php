<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setup\SetupCounter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SetupCounterSeeder extends Seeder
{
    public function run(): void
    {
        $counters = [
        ['counter_id' => 'USER', 'counter_value' => 0, 'counter_description' => 'COUNT NUMBER OF USER'],
        ['counter_id' => 'STAFF', 'counter_value' => 0, 'counter_description' => 'COUNT NUMBER OF STAFF'],
    ];

    foreach ($counters as $counter) {
        SetupCounter::firstOrCreate(
            ['counter_id' => $counter['counter_id']], // Check column
            ['counter_value' => $counter['counter_value'], 'counter_description' => $counter['counter_description']] // Insert if not exists
        );
    }
    }
}
