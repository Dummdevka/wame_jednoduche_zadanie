@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<?php $update = isset($tag) ?>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $update ? 'Update tag' : 'Create tag'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <form action="{{$update ? route('tags.update', $tag->id) : route('tags.store')}}" method="post" class="w-100 d-flex flex-column align-items-center">
                    @csrf
                    @if($update) @method("PUT") @endif
                    @include('components.input', ['name' => 'title', 'value' => $update ? $tag->title : old('title')])
                    
                    <button type="submit"
                    class="btn btn-success mt-2">{{$update ? 'Update' : 'Create'}}</button>
                </form>
                
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
