<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'training_history',
        'attendance_records',
        'file_compliance',
        'color_tags',
        'custom_fields',
        'notes',
        'communication_history',
        'transaction_history',
        'is_archived',
        'last_activity_at',
    ];

    protected function casts(): array
    {
        return [
            'training_history' => 'json',
            'attendance_records' => 'json',
            'file_compliance' => 'json',
            'color_tags' => 'json',
            'custom_fields' => 'json',
            'communication_history' => 'json',
            'transaction_history' => 'json',
            'is_archived' => 'boolean',
            'last_activity_at' => 'datetime',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
