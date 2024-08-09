<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sample extends Model
{
    use HasFactory;
    protected $table='users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp_for_password_reset'
    ];
}
