<?php

namespace App\Http\Controllers\Web;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.tasks.index')->with([
            'title' => 'Tasks',
            'tags' => Tag::pluck('title')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tasks.create')->with([
            'projects' => Project::all(),
            'tags' => Tag::all(),
            'clients' => Client::all(),
            'users' => User::all()
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
            'project_id' => 'required|id:tasks',
            'user_id' => 'required|id:users',
            'title' => 'required'
        ]);
        $task = Tag::create($request->all());

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('pages.tasks.show')->with([
            'tag' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('pages.tasks.create')->with([
            'tag' => $task,
            'projects' => Project::all(),
            'tags' => Tag::all(),
            'clients' => Client::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required|id:tasks',
            'user_id' => 'required|id:users',
            'title' => 'required'
        ]);

        // $tags = Tag::where('title', $request->title)->where('id', '!=', $id)->get();
        // if(!$tags->isEmpty()) {
        //     return redirect()->back()->withErrors(['title' => 'This title already exists']);
        // }
        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();
        return view('pages.tasks.index');
    }
}
