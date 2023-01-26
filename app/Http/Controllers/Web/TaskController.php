<?php

namespace App\Http\Controllers\Web;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\TaskNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

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
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'title' => 'required'
        ]);
        $task = Task::create($request->all());

        $task->tags()->attach($request->tag_ids);
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
            'task' => $task,
            'users' => User::all(),
            'projects' => Project::all(),
            'tags' => Tag::all(),
            'selected_tags' => $task->tags
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
            'task' => $task,
            'projects' => Project::all(),
            'tags' => Tag::all(),
            'selected_tags' => $task->tags->pluck('id')->toArray(),
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
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'title' => 'required'
        ]);

        // $tags = Tag::where('title', $request->title)->where('id', '!=', $id)->get();
        // if(!$tags->isEmpty()) {
        //     return redirect()->back()->withErrors(['title' => 'This title already exists']);
        // }
        $task = Task::findOrFail($id);
        $task->update($request->all());

        $task->tags()->sync($request->tag_ids);

        //Notify users
        // $admins = Role::where('name', 'admin')->users;
        Notification::send(User::all(), new TaskNotification($task));

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
