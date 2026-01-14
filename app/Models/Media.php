<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'order',
        'is_active',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }
}
