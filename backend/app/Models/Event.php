<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'type',
        'user_id',
        'subject_type',
        'subject_id',
        'description',
        'event_data',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'event_data' => 'json',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->morphTo();
    }
}
