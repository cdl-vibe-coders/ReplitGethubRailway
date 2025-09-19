<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingPackage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_days',
        'max_participants',
        'requirements',
        'file_requirements',
        'terms_conditions',
        'enrollment_url_token',
        'is_active',
        'allow_self_enrollment',
        'email_templates',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'requirements' => 'json',
            'file_requirements' => 'json',
            'email_templates' => 'json',
            'is_active' => 'boolean',
            'allow_self_enrollment' => 'boolean',
        ];
    }

    // Relationships
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
