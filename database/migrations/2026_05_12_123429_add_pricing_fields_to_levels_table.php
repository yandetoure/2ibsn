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
        Schema::table('levels', function (Blueprint $table) {
            $table->string('category')->after('code')->nullable(); // preschool, elementary, college
            $table->decimal('registration_fee', 10, 2)->default(0)->after('monthly_fee');
            $table->decimal('half_pension_registration_fee', 10, 2)->default(0)->after('registration_fee');
            $table->decimal('half_pension_monthly_fee', 10, 2)->default(0)->after('half_pension_registration_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'registration_fee',
                'half_pension_registration_fee',
                'half_pension_monthly_fee'
            ]);
        });
    }
};
