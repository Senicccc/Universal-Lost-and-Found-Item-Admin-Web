<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::with(['user', 'item'])->get();
        return view('bookmarks.index', compact('bookmarks'));
    }
}