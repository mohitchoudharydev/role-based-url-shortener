<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'original_url',
        'short_code',
    ];
    // a short url belongs to a user and a company
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // a short url belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function scopeVisibleTo($query, User $user)
{
    
    if ($user->role === 'SuperAdmin') {
        return $query;
    }

    if ($user->role === 'Admin') {
        return $query->where(
            'company_id',
            $user->company_id
        );
    }

    return $query->where(
        'user_id',
        $user->id
    );
}
}
