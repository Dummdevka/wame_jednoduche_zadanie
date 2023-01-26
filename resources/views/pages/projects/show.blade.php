@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Show project'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                @if($project->image)
                <div class="w-100 ms-3 me-3">
                    <img src="{{$project->image}}" alt="" height="200" class="mt-2 mb-2">
                </div>
                @endif
                <form action="{{route('projects.store')}}" method="post" class="w-100 d-flex flex-column align-items-center">
                    @csrf
                    
                    @include('components.input', ['name' => 'name', 'value' => $project->name, 'show' => true])
                    @include('components.input', ['name' => 'description', 'value' => $project->description, 'show' => true])
                    @include('components.select', ['name' => 'client_id', 'options' => $clients, 'selected' => $project->client_id , 'option_val' => 'id', 'label' => 'name', 'show' => true])
                    @include('components.select', ['name' => 'status', 'options' => $statuses, 'selected' => $project->status, 'show' => true])
                    <div class="w-25">
                        <label for="dedline" class="form-control-label @error('deadline') text-danger @enderror">Deadline:</label>
                        
                        <input type="date" name="deadline" id="deadline" class="form-control"
                        value="{{$project->deadline}}" disabled>
                    </div>
                    <div class="w-25">
                        <label for="user_ids" class="form-control-label @error('user_ids') text_danger @enderror">Assigned users: </label>
                        <select data-placeholder="Begin typing a name to filter..." 
                        name="user_ids[]" id="user_ids" 
                        class="chosen-select form-control" multiple 
                        disabled
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if(in_array($user->id, $selected_users)) selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    
                    @can('admin')
                        <button type="button"
                        class="btn btn-success mt-2"><a href="{{route('projects.edit', $project->id)}}">{{'Update'}}</a></button>
                    @endcan
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
