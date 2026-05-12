<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category',
        'description',
        'monthly_fee',
        'registration_fee',
        'half_pension_registration_fee',
        'half_pension_monthly_fee',
        'is_active',
    ];

    protected $casts = [
        'monthly_fee' => 'decimal:2',
        'registration_fee' => 'decimal:2',
        'half_pension_registration_fee' => 'decimal:2',
        'half_pension_monthly_fee' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
