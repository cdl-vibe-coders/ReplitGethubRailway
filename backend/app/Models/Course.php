<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'training_package_id',
        'title',
        'description',
        'trainer_id',
        'start_datetime',
        'end_datetime',
        'location',
        'max_participants',
        'status',
        'session_items',
        'completion_criteria',
        'certificate_enabled',
        'certificate_template',
    ];

    protected function casts(): array
    {
        return [
            'start_datetime' => 'datetime',
            'end_datetime' => 'datetime',
            'session_items' => 'json',
            'completion_criteria' => 'json',
            'certificate_enabled' => 'boolean',
        ];
    }

    // Relationships
    public function trainingPackage()
    {
        return $this->belongsTo(TrainingPackage::class);
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function trainingSessions()
    {
        return $this->hasMany(TrainingSession::class);
    }
}
