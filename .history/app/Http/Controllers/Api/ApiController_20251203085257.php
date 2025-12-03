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

    /**
     * Return a consistent JSON error envelope
     */
    protected function jsonError($message = 'Unauthorized', $code = 401)
    {
        return response()->json(['success' => false, 'error' => $message], $code);
    }

    /**
     * Return a consistent success envelope
     */
    protected function jsonSuccess($data = null, $code = 200)
    {
        return response()->json(['success' => true, 'data' => $data], $code);
    }
}