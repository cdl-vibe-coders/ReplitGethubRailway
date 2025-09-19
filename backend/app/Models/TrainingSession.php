<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'trainer_id',
        'session_datetime',
        'duration_minutes',
        'location',
        'status',
        'session_data',
        'notes',
        'attendance_confirmed',
        'check_in_time',
        'check_out_time',
    ];

    protected function casts(): array
    {
        return [
            'session_datetime' => 'datetime',
            'session_data' => 'json',
            'attendance_confirmed' => 'boolean',
            'check_in_time' => 'datetime',
            'check_out_time' => 'datetime',
        ];
    }

    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}
