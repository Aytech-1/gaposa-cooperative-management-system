<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setup\SetupCountry;

class SetupCountrySeeder extends Seeder
{

    // Run the database seeds.
    public function run(): void
    {
        $countries = [
            ['country_name' => 'Nigeria', 'country_code' => 'NG'],
        ];

        foreach ($countries as $country) {
            SetupCountry::firstOrCreate([
                'country_name' => $country['country_name'],
                'country_code' => $country['country_code']
            ]);
        }
    }
}
