<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function test()
    {
        return response()->json([
            'success' => true,
            'message' => 'Hello World'
        ]);
    }

    public function unauthorized()
    {
        return response()->json([
            'message' => 'Unauthorized.'
        ], 401);
    }
}
