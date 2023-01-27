@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Show task'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <form action="{{route('tasks.store')}}" method="post" class="w-100 d-flex flex-column align-items-center">
                    @csrf
                    
                    @include('components.input', ['name' => 'title', 'value' => $task->title, 'show' => true])
                    @include('components.input', ['name' => 'description', 'value' => $task->description, 'show' => true])
                    @include('components.select', ['name' => 'project_id', 'options' => $projects, 'selected' => $task->project_id , 'option_val' => 'id', 'label' => 'name', 'show' => true])
                    @include('components.select', ['name' => 'user_id', 'options' => $users, 'selected' => $task->user->id, 'option_val' => 'id', 'label' => 'name', 'show' => true])
                    {{-- <div class="w-25">
                        <label for="dedline" class="form-control-label @error('deadline') text-danger @enderror">Deadline:</label>
                        
                        <input type="date" name="deadline" id="deadline" class="form-control"
                        value="{{$task->deadline}}" disabled>
                    </div> --}}
                    <div class="w-25">
                        <label for="tag_ids" class="form-control-label @error('user_ids') text_danger @enderror">Tags: </label>
                        <select data-placeholder="No tags yet" 
                        name="tag_ids[]" id="tag_ids" 
                        class="chosen-select form-control" multiple 
                        disabled>
                            @foreach($selected_tags as $tag)
                                <option value="{{$tag->id}}" selected>{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    @canany(['admin', 'can-edit-task'])
                        <button type="button"
                        class="btn btn-success mt-2"><a href="{{route('tasks.edit', $task->id)}}">{{'Update'}}</a></button>
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
