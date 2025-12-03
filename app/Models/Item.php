<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'city',
        'province',
        'address',
        'image_url',
        'status',
    ];

    // Each item belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An item can be bookmarked by many users
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    // Logs related to the item
    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}