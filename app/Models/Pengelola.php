<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengelola extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'penggunaweb';
    protected $primaryKey = 'id_penggunaWeb';

    protected $fillable=[
        'name',
        'email',
        'password',
        'role_id',
        'kontak',
        'status',
        'is_approved'
    ];
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $cast=[
        'email_verified_at' => 'datetime',
    ];
}
