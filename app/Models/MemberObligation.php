<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberObligation extends Model
{
    protected $fillable = [
        'user_id',
        'reason',
        'amount',
        'is_paid',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'amount' => 'decimal:2',
    ];

    // relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}