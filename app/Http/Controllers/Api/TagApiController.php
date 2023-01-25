<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagApiController extends Controller
{
    public function index(Request $request) {
        $tags = Tag::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => TagResource::collection($tags)
        ]);
    }
}
