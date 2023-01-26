@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<?php $update = isset($project);
$old_ids = old('user_ids') ?: [] ?>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $update ? 'Update project' : 'Create project'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <form action="{{$update ? route('projects.update', $project->id) : route('projects.store')}}" method="post" class="w-100 d-flex flex-column align-items-center" enctype="multipart/form-data">
                    @csrf
                    @if($update) @method("PUT") @endif
                    <div class="w-25">
                        <label class="form-control-label">Image: </label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    @include('components.input', ['name' => 'name', 'value' => $update ? $project->name : old('name')])
                    @include('components.input', ['name' => 'description', 'value' => $update ? $project->description : old('description')])
                    @include('components.select', ['name' => 'client_id', 'options' => $clients, 'selected' => $update ? $project->client_id : old('client_id'), 'option_val' => 'id', 'label' => 'name'])
                    @include('components.select', ['name' => 'status', 'options' => $statuses, 'selected' => $update ? $project->status : old('status')])
                    <div class="w-25">
                        <label for="dedline" class="form-control-label @error('deadline') text-danger @enderror">Deadline:</label>
                        
                        <input type="date" name="deadline" id="deadline" class="form-control"
                        value="@if($update) {{$project->deadline}} @else {{old('deadline')}}@endif">
                    </div>
                    <div class="w-25">
                        <label for="user_ids" class="form-control-label @error('user_ids') text_danger @enderror">Assigned users: </label>
                        <select data-placeholder="Begin typing a name to filter..." 
                        name="user_ids[]" id="user_ids" 
                        class="chosen-select form-control" multiple 
                        value="[26,57]"
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if(($update && in_array($user->id, $selected_users)) || in_array($user->id, $old_ids)) selected @endif>{{$user->name}}</option>
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