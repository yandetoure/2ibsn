<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            // Préscolaire
            ['name' => 'Petite Section', 'code' => 'PS', 'monthly_fee' => 12000, 'description' => 'Petite Section - Préscolaire'],
            ['name' => 'Moyenne Section', 'code' => 'MS', 'monthly_fee' => 12000, 'description' => 'Moyenne Section - Préscolaire'],
            ['name' => 'Grande Section', 'code' => 'GS', 'monthly_fee' => 12000, 'description' => 'Grande Section - Préscolaire'],
            
            // Élémentaire
            ['name' => 'CI', 'code' => 'CI', 'monthly_fee' => 12000, 'description' => 'Cours d\'Initiation'],
            ['name' => 'CP', 'code' => 'CP', 'monthly_fee' => 12000, 'description' => 'Cours Préparatoire'],
            ['name' => 'CE1', 'code' => 'CE1', 'monthly_fee' => 12000, 'description' => 'Cours Élémentaire 1ère année'],
            ['name' => 'CE2', 'code' => 'CE2', 'monthly_fee' => 12000, 'description' => 'Cours Élémentaire 2ème année'],
            ['name' => 'CM1', 'code' => 'CM1', 'monthly_fee' => 12000, 'description' => 'Cours Moyen 1ère année'],
            ['name' => 'CM2', 'code' => 'CM2', 'monthly_fee' => 12000, 'description' => 'Cours Moyen 2ème année'],
            
            // Secondaire
            ['name' => '6ème', 'code' => '6EME', 'monthly_fee' => 17000, 'description' => '6ème année'],
            ['name' => '5ème', 'code' => '5EME', 'monthly_fee' => 17000, 'description' => '5ème année'],
            ['name' => '4ème', 'code' => '4EME', 'monthly_fee' => 19000, 'description' => '4ème année'],
            ['name' => '3ème', 'code' => '3EME', 'monthly_fee' => 25000, 'description' => '3ème année'],
        ];

        foreach ($levels as $level) {
            Level::create([
                'name' => $level['name'],
                'code' => $level['code'],
                'monthly_fee' => $level['monthly_fee'],
                'description' => $level['description'],
                'is_active' => true,
            ]);
        }
    }
}
