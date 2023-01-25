@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<?php $update = isset($client) ?>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $update ? 'Update client' : 'Create user'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <form action="{{$update ? route('clients.update', $client->id) : route('clients.store')}}" method="post" class="w-100 d-flex flex-column align-items-center">
                    @csrf
                    @if($update) @method("PUT") @endif
                    @include('components.input', ['name' => 'name', 'value' => $update ? $client->name : old('name')])
                    @include('components.input', ['name' => 'email', 'value' => $update ? $client->email : old('email')])
                    @include('components.input', ['name' => 'phone', 'value' => $update ? $client->phone : old('phone')])
                    @include('components.input', ['name' => 'company_name', 'value' => $update ? $client->company_name : old('company_name')])
                    <div class="w-25">
                        <label for="self_employed" class="form-control-label">Self employee</label> 
                        <input type="checkbox" name="self_employed" id="self_employed">
                    </div>
                    
                    
                    <button type="submit"
                    class="btn btn-success mt-2">{{$update ? 'Update' : 'Create'}}</button>
                </form>
                
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
