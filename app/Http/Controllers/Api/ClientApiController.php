<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;

class ClientApiController extends Controller
{
    public function index(Request $request) {
        $clients = Client::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => ClientResource::collection($clients)
        ]);
    }
}
