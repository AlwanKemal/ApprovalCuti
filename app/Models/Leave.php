<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'approver1_id', 'approver2_id', 'start_date', 'end_date', 'status_approver1', 'status_approver2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver1()
    {
        return $this->belongsTo(User::class, 'approver1_id');
    }

    public function approver2()
    {
        return $this->belongsTo(User::class, 'approver2_id');
    }

    public function division()
    {
        return $this->user->division; 
    }

    public function validateApprovers()
    {
        $userDivisionId = $this->user->division_id;

        return $this->approver1->division_id === $userDivisionId &&
               $this->approver2->division_id === $userDivisionId;
    }
}

