<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setup\SetupStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SetupStatusSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        $statuses = ['ACTIVE', 'INACTIVE', 'PENDING', 'APPROVED', 'DECLINED', 'SUSPENDED', 'DELETED', 'COMPLETED', 'CANCELLED', 'FAILED'];
        foreach ($statuses as $status) {
            SetupStatus::firstOrCreate(['status_name' => $status]);
        }
    }
}
