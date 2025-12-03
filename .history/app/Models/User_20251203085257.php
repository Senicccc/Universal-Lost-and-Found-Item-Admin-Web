<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
    ];

    /**
     * Hide sensitive attributes from JSON responses
     */
    protected $hidden = [
        'password',
    ];

    // A user can upload many items
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // A user can bookmark many items
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    // A user can have many logs
    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}