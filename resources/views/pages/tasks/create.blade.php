@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<?php $update = isset($task);
$old_ids = old('user_ids') ?: [] ?>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $update ? 'Update task' : 'Create project'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <form action="{{$update ? route('tasks.update', $task->id) : route('tasks.store')}}" method="post" class="w-100 d-flex flex-column align-items-center">
                    @csrf
                    @if($update) @method("PUT") @endif
                    @include('components.input', ['name' => 'title', 'value' => $update ? $task->title : old('title')])
                    @include('components.input', ['name' => 'description', 'value' => $update ? $task->description : old('description')])
                    @can('admin')@include('components.select', ['name' => 'project_id', 'options' => $projects, 'selected' => $update ? $task->project_id : old('project_id'), 'option_val' => 'id', 'label' => 'name'])@endcan
                    @can('can-edit-task')
                        @include('components.select', ['name' => 'project_id', 'options' => $projects, 'selected' => $update ? $task->project_id : old('project_id'), 'option_val' => 'id', 'label' => 'name', 'show' => true])
                        <input type="hidden" name="project_id" value="{{$task->project_id}}">
                    @endcan

                    @can('admin')@include('components.select', ['name' => 'user_id', 'options' => $users, 'selected' => $update ? $task->user->id : old('user_id'), 'option_val' => 'id', 'label' => 'name'])@endcan

                    @can('can-edit-task')
                        @include('components.select', ['name' => 'user_id', 'options' => $users, 'selected' => $update ? $task->user->id : old('user_id'), 'option_val' => 'id', 'label' => 'name', 'show' => true])
                        <input type="hidden" name="user_id" value="{{$task->user_id}}">
                    @endcan
                    <div class="w-25">
                        <label for="tag_ids" class="form-control-label @error('tag_ids') text_danger @enderror">Tags: </label>
                        <select data-placeholder="Begin typing a name to filter..." 
                        name="tag_ids[]" id="tag_ids" 
                        class="chosen-select form-control" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" @if(($update && in_array($tag->id, $selected_tags)) || in_array($tag->id, $old_ids)) selected @endif>{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                    class="btn btn-success mt-2">{{$update ? 'Update' : 'Create'}}</button>
                </form>
                
            </div>
        </div>

        <script>
            $(function() {
                // let chosen = 
                $(".chosen-select").chosen({
                    no_results_text: "Oops, nothing found!",
                    // values: [27, 55]
                })
            });
            
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection