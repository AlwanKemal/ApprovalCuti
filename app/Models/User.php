<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'division_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isApprover()
    {
        return $this->role === 'approver1' || $this->role === 'approver2';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
