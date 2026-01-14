<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'level_id',
        'school_year_id',
        'enrollment_date',
        'first_monthly_paid',
        'first_monthly_included',
        'total_paid',
        'remaining_amount',
        'monthly_fee',
        'status',
        'notes',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'first_monthly_paid' => 'decimal:2',
        'total_paid' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'monthly_fee' => 'decimal:2',
        'first_monthly_included' => 'boolean',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
