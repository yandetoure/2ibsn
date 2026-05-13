<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \App\Models\Setting::updateOrCreate(
            ['key' => 'show_events_section'],
            [
                'value' => '0',
                'type' => 'boolean',
                'group' => 'appearance',
                'description' => 'Afficher ou masquer la section des événements sur la page d\'accueil.'
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\Setting::where('key', 'show_events_section')->delete();
    }
};
