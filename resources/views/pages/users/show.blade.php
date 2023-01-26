@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Show user'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <form action="{{route('users.store')}}" method="post" class="w-100 d-flex flex-column align-items-center">
                    @csrf
                    @include('components.input', ['name' => 'name', 'value' => $user->name, 'show' => true])
                    @include('components.input', ['name' => 'email', 'value' => $user->email, 'show' => true])
                    @include('components.input', ['name' => 'password', 'value' => $user->password, 'show' => true])
                    @include('components.input', ['name' => 'city', 'value' => $user->city, 'show' => true])
                    @include('components.input', ['name' => 'country', 'value' => $user->country, 'show' => true])
                    @include('components.input', ['name' => 'role', 'value' => $user->role, 'show' => true])
                    
                    @can('admin')
                        <button type="button"
                        class="btn btn-success mt-2"><a href="{{route('users.edit', $user->id)}}">{{'Update'}}</a></button>
                    @endcan

                    @if(!$tasks->isEmpty())
                        <div class="w-25 d-flex flex-column">
                            <span class="bold">Tasks:</span>
                            @foreach($tasks as $task)
                                <a href="{{route('tasks.show', $task->id)}}" class="m-3 border border-success rounded text-center">{{$task->title}}</a>
                            @endforeach
                        </div>
                    @endif
                </form>
                
            </div>
        </div>

       
        @include('layouts.footers.auth.footer')
    </div>
@endsection
