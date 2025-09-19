<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'permissions',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'permissions' => 'json',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->name === 'ADMIN';
    }

    public function isTrainer()
    {
        return $this->name === 'TRAINER';
    }

    public function isUser()
    {
        return $this->name === 'USER';
    }

    public function isCredential()
    {
        return $this->name === 'CREDENTIAL';
    }
}
