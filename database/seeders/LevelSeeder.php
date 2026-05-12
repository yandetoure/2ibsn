<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            // Préscolaire
            [
                'name' => 'Petite Section', 'code' => 'PS', 'category' => 'preschool',
                'registration_fee' => 24000, 'monthly_fee' => 12000,
                'half_pension_registration_fee' => 24000, 'half_pension_monthly_fee' => 20000,
                'description' => 'Petite Section - Préscolaire'
            ],
            [
                'name' => 'Moyenne Section', 'code' => 'MS', 'category' => 'preschool',
                'registration_fee' => 24000, 'monthly_fee' => 12000,
                'half_pension_registration_fee' => 24000, 'half_pension_monthly_fee' => 20000,
                'description' => 'Moyenne Section - Préscolaire'
            ],
            [
                'name' => 'Grande Section', 'code' => 'GS', 'category' => 'preschool',
                'registration_fee' => 24000, 'monthly_fee' => 12000,
                'half_pension_registration_fee' => 24000, 'half_pension_monthly_fee' => 20000,
                'description' => 'Grande Section - Préscolaire'
            ],
            
            // Élémentaire
            [
                'name' => 'CI', 'code' => 'CI', 'category' => 'elementary',
                'registration_fee' => 25000, 'monthly_fee' => 12000,
                'half_pension_registration_fee' => 25000, 'half_pension_monthly_fee' => 25000,
                'description' => 'Cours d\'Initiation'
            ],
            [
                'name' => 'CP', 'code' => 'CP', 'category' => 'elementary',
                'registration_fee' => 25000, 'monthly_fee' => 12000,
                'half_pension_registration_fee' => 25000, 'half_pension_monthly_fee' => 25000,
                'description' => 'Cours Préparatoire'
            ],
            [
                'name' => 'CE1', 'code' => 'CE1', 'category' => 'elementary',
                'registration_fee' => 25000, 'monthly_fee' => 12000,
                'half_pension_registration_fee' => 29000, 'half_pension_monthly_fee' => 29000,
                'description' => 'Cours Élémentaire 1ère année'
            ],
            [
                'name' => 'CE2', 'code' => 'CE2', 'category' => 'elementary',
                'registration_fee' => 25000, 'monthly_fee' => 12000,
                'half_pension_registration_fee' => 29000, 'half_pension_monthly_fee' => 29000,
                'description' => 'Cours Élémentaire 2ème année'
            ],
            [
                'name' => 'CM1', 'code' => 'CM1', 'category' => 'elementary',
                'registration_fee' => 25000, 'monthly_fee' => 12000,
                'half_pension_registration_fee' => 33000, 'half_pension_monthly_fee' => 33000,
                'description' => 'Cours Moyen 1ère année'
            ],
            [
                'name' => 'CM2', 'code' => 'CM2', 'category' => 'elementary',
                'registration_fee' => 25000, 'monthly_fee' => 12000,
                'half_pension_registration_fee' => 33000, 'half_pension_monthly_fee' => 33000,
                'description' => 'Cours Moyen 2ème année'
            ],
            
            // Collège
            [
                'name' => '6ème', 'code' => '6EME', 'category' => 'college',
                'registration_fee' => 34000, 'monthly_fee' => 17000,
                'half_pension_registration_fee' => 0, 'half_pension_monthly_fee' => 0,
                'description' => '6ème année du Collège'
            ],
            [
                'name' => '5ème', 'code' => '5EME', 'category' => 'college',
                'registration_fee' => 34000, 'monthly_fee' => 17000,
                'half_pension_registration_fee' => 0, 'half_pension_monthly_fee' => 0,
                'description' => '5ème année du Collège'
            ],
            [
                'name' => '4ème', 'code' => '4EME', 'category' => 'college',
                'registration_fee' => 44000, 'monthly_fee' => 19000,
                'half_pension_registration_fee' => 0, 'half_pension_monthly_fee' => 0,
                'description' => '4ème année du Collège'
            ],
            [
                'name' => '3ème', 'code' => '3EME', 'category' => 'college',
                'registration_fee' => 50000, 'monthly_fee' => 25000,
                'half_pension_registration_fee' => 0, 'half_pension_monthly_fee' => 0,
                'description' => '3ème année du Collège'
            ],
        ];

        foreach ($levels as $level) {
            Level::updateOrCreate(['code' => $level['code']], $level);
        }
    }
}
