<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setup\SetupTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SetupTitleSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        $titles = ['MR', 'MRS', 'MISS', 'DR', 'PROF', 'ENGR', 'HON', 'CHIEF', 'REV', 'PASTOR'];
        foreach ($titles as $title) {
            SetupTitle::firstOrCreate(['title_name' => $title]);
        }
    }
}
