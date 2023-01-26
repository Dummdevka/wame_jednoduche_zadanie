<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagApiController extends Controller
{
    public function index(Request $request) {
        $tags = Tag::query();

        if($request->status) {
            if(in_array(ucfirst($request->status), Tag::pluck('title')->toArray())) {
                $tags = Tag::where('title', $request->status)->first()->tasks();
            }
        }

        return response()->json([
            'success' => true,
            'data' => TagResource::collection($tags->orderBy('created_at', 'desc')->get())
        ]);
    }
}
