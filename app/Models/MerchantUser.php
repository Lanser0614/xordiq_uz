<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MerchantUser extends Authenticate
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'merchant_users';
}
