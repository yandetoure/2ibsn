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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('level_id')->constrained('levels')->onDelete('restrict');
            $table->date('enrollment_date');
            $table->decimal('first_monthly_paid', 10, 2)->default(0);
            $table->boolean('first_monthly_included')->default(false);
            $table->decimal('total_paid', 10, 2)->default(0);
            $table->decimal('remaining_amount', 10, 2)->default(0);
            $table->decimal('monthly_fee', 10, 2)->default(0);
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
