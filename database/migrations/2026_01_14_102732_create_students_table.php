<?php declare(strict_types=1); 

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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['M', 'F']);
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('nationality');
            $table->string('spoken_language'); // Wolof, Poular, Sérère, Autres
            $table->string('other_language')->nullable();
            $table->foreignId('level_id')->nullable()->constrained('levels')->onDelete('set null');
            $table->boolean('is_boarding')->default(false); // Internat
            $table->boolean('is_day_student')->default(false); // Externat
            $table->boolean('is_holiday')->default(false); // Vacance
            $table->boolean('is_preschool')->default(false); // Préscolaire
            // Informations parentales
            $table->string('father_name')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_phone')->nullable();
            $table->text('parents_address')->nullable();
            $table->string('villa_number')->nullable();
            $table->string('responsible_name')->nullable();
            $table->string('responsible_phone')->nullable();
            // Informations administratives
            $table->date('entry_date');
            $table->date('exit_date')->nullable();
            $table->text('exit_reason')->nullable();
            $table->text('observations')->nullable();
            $table->enum('status', ['active', 'inactive', 'graduated', 'transferred'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
