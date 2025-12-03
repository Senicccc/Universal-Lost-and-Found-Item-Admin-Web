<?php

namespace App\Http\Controllers;

use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::orderBy('created_at', 'desc')->get();
        return view('logs.index', compact('logs'));
    }
}