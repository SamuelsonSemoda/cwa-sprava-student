<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'class',
        'birth_date',
        'phone',
        'note',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function getAverageGradeAttribute(): ?float
    {
        $avg = $this->grades()->avg('value');
        return $avg !== null ? round($avg, 2) : null;
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
