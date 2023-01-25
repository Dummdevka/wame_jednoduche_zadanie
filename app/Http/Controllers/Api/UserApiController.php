<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserApiController extends Controller
{
    public function index(Request $request) {
        $users = User::orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => UserResource::collection($users)
        ]);
    }
}
