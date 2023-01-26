<?php

namespace App\Http\Controllers\Web;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Enums\Status;
use App\Models\Client;
use App\Models\User;
use App\Http\Traits\ImageTrait;

class ProjectController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);   
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.projects.index')->with([
            'title' => 'Projects',
            'statuses' => array_column(Status::cases(), 'name')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.projects.create')->with([
            'projects' => Project::all(),
            'statuses' => array_column(Status::cases(), 'name'),
            'clients' => Client::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'user_ids' => 'required',
            'name' => 'required',
            'deadline' => 'required'
        ]);
        $project = Project::create($request->all());
        $project->users()->attach($request->user_ids);
        if($request->file('image')) {
            $this->upload_image($project, $request->file('image'), 'projects');
        }

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('pages.projects.show')->with([
            'project' => $project,
            'statuses' => [$project->status],
            'clients' => [$project->client],
            // 'users' => User::all(),
            'selected_users' => $project->users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('pages.projects.create')->with([
            'project' => $project,
            'statuses' => array_column(Status::cases(), 'name'),
            'clients' => Client::all(),
            'users' => User::all(),
            'selected_users' => $project->users->pluck('id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'client_id' => 'required',
            'user_ids' => 'required',
            'name' => 'required',
            'deadline' => 'required'
        ]);
        $project->update($request->all());
        $project->users()->sync($request->user_ids);
        if($request->file('image')) {
            $this->upload_image($project, $request->file('image'), 'projects');
            // dd($project->image);
        }

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();
        return view('pages.projects.index');
    }
}
