<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setup\SetupGender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SetupGenderSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {  
        SetupGender::firstOrCreate(['gender_name' => 'MALE']); 
        SetupGender::firstOrCreate(['gender_name' => 'FEMALE']); 
    }
}
