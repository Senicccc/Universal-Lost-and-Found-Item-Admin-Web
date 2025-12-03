<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Log;

class LogApiController extends ApiController
{
    public function index()
    {
        $logs = Log::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($logs);
    }
}
