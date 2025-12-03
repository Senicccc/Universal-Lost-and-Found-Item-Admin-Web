<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Get authenticated user from bearer token (api_token)
     */
    protected function userFromToken(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) return null;
        return \App\Models\User::where('api_token', $token)->first();
    }

    protected function jsonError($message = 'Unauthorized', $code = 401)
    {
        return response()->json(['error' => $message], $code);
    }
}
