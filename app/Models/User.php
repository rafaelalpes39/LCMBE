<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'cp_number',
        'role',
        'team',
        'status',
        'password',
        'profile',
        'membership_expiration',
        'joined_date',
        'membership_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
