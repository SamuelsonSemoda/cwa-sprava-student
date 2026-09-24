<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'task_id',
        'subject',
        'value',
        'date',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
        'value' => 'integer',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public static function labels(): array
    {
        return [
            1 => 'Výborný',
            2 => 'Chvalitebný',
            3 => 'Dobrý',
            4 => 'Dostatečný',
            5 => 'Nedostatečný',
        ];
    }

    public function getLabelAttribute(): string
    {
        return self::labels()[$this->value] ?? (string) $this->value;
    }
}
