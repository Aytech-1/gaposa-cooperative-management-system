<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setup\SetupState;

class SetupStateSeeder extends Seeder
{

    // Run the database seeds.
     public function run(): void
    {
        $states = [
            'Abia',
            'Adamawa',
            'Akwa Ibom',
            'Anambra',
            'Bauchi',
            'Bayelsa',
            'Benue',
            'Borno',
            'Cross River',
            'Delta',
            'Ebonyi',
            'Edo',
            'Ekiti',
            'Enugu',
            'Gombe',
            'Imo',
            'Jigawa',
            'Kaduna',
            'Kano',
            'Katsina',
            'Kebbi',
            'Kogi',
            'Kwara',
            'Lagos',
            'Nasarawa',
            'Niger',
            'Ogun',
            'Ondo',
            'Osun',
            'Oyo',
            'Plateau',
            'Rivers',
            'Sokoto',
            'Taraba',
            'Yobe',
            'Zamfara',
            'Federal Capital Territory',
        ];

        foreach ($states as $state) {
            SetupState::updateOrCreate(
                [
                    'country_id' => 1,
                    'state_name' => $state,
                ], 
            );
        }
    }
}
