<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Models\Tag;

class TaskApiController extends Controller
{
    public function index(Request $request) {
        $tasks = null;
        if($request->status) {
            $tasks = Tag::where('title', $request->status)->first()->tasks(); 
        } 
        $tasks = $tasks ?: Task::query();
        
        $tasks = $tasks->orderBy('created_at', 'desc')->get();


        return response()->json([
            'success' => true,
            'data' => TaskResource::collection($tasks)
        ]);
    }
}
