<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Bookmark;
use App\Models\Log;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'total_users'      => User::count(),
            'total_items'      => Item::count(),
            'unclaimed_items'  => Item::where('status', 'unclaimed')->count(),
            'claimed_items'    => Item::where('status', 'claimed')->count(),
            'total_bookmarks'  => Bookmark::count(),
            'total_logs'       => Log::count(),
        ]);
    }
}