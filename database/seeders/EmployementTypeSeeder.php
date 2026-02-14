<?php


namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Setup\EmployementType;


class EmployementTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'EMPLOYED',
            'SELF-EMPLOYED',
            'UNEMPLOYED',
            'RETIRED',
            'STUDENT',
            'CONTRACTOR',
        ];

        foreach ($types as $type) {
            EmployementType::firstOrCreate([
                'employement_type_name' => $type,
            ]);
        }
    }
}
