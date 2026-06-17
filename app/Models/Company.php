<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];

    // a company can have many users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
