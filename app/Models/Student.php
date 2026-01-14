<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'birth_place',
        'nationality',
        'spoken_language',
        'other_language',
        'level_id',
        'is_boarding',
        'is_day_student',
        'is_holiday',
        'is_preschool',
        'father_name',
        'father_phone',
        'mother_name',
        'mother_phone',
        'parents_address',
        'villa_number',
        'responsible_name',
        'responsible_phone',
        'entry_date',
        'exit_date',
        'exit_reason',
        'observations',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'entry_date' => 'date',
        'exit_date' => 'date',
        'is_boarding' => 'boolean',
        'is_day_student' => 'boolean',
        'is_holiday' => 'boolean',
        'is_preschool' => 'boolean',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function currentEnrollment(): HasOne
    {
        return $this->hasOne(Enrollment::class)->where('status', 'active')->latest();
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
