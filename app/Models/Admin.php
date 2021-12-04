<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $fillable = ["name", "email", "username", "password"];

    public function setPasswordAttribute($password){
        $this->attributes["password"] = Hash::make($password);
    }
}
