<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
    ];

    // Bookmark belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Bookmark belongs to an item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}