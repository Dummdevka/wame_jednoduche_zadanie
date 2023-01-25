@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<?php $update = isset($user) ?>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $update ? 'Update user' : 'Create user'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <form action="{{$update ? route('users.update', $user->id) : route('users.store')}}" method="post" class="w-100 d-flex flex-column align-items-center">
                    @csrf
                    @if($update) @method("PUT") @endif
                    @include('components.input', ['name' => 'name', 'value' => $update ? $user->name : ''])
                    @include('components.input', ['name' => 'email', 'value' => $update ? $user->email : ''])
                    @if(!$update)@include('components.input', ['name' => 'password', 'value' => $update ? $user->password : ''])@endif
                    @include('components.input', ['name' => 'city', 'value' => $update ? $user->city : ''])
                    @include('components.input', ['name' => 'country', 'value' => $update ? $user->country : ''])
                    <div class="w-25">
                        <label for="role" class="form-control-label">Role: </label>
                        <select name="role" id="role" class="form-select w-100">
                            @foreach($roles as $role)
                                <option value="{{$role->name}}" 
                                    @if(($role->name == 'user' && !$update) || ($update && $user->role = $role->name)) 
                                    selected @endif>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit"
                    class="btn btn-success mt-2">{{$update ? 'Update' : 'Create'}}</button>
                </form>
                
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
