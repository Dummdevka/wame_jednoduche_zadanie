<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Enums\Status;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
    public function index(Request $request) {
        
        $projects = Project::orderBy('created_at', 'desc');

        if($request->status) {
            if(in_array(strtoupper($request->status), array_column(Status::cases(), 'name'))) {
                $projects->byStatus($request->status);
            }
        }

        return response()->json([
            'success' => true,
            'data' => ProjectResource::collection($projects->get())
        ]);
    }
}
