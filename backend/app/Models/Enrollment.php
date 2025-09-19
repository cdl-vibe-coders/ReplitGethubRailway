<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id',
        'training_package_id',
        'course_id',
        'status',
        'enrollment_data',
        'uploaded_files',
        'amount_paid',
        'payment_status',
        'payment_transaction_id',
        'enrolled_at',
        'completed_at',
        'completion_percentage',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'enrollment_data' => 'json',
            'uploaded_files' => 'json',
            'amount_paid' => 'decimal:2',
            'enrolled_at' => 'datetime',
            'completed_at' => 'datetime',
            'completion_percentage' => 'decimal:2',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainingPackage()
    {
        return $this->belongsTo(TrainingPackage::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
