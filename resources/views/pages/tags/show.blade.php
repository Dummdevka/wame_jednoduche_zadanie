@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Show tag'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <form action="{{route('tags.store')}}" method="post" class="w-100 d-flex flex-column align-items-center">
                    @csrf
                    @include('components.input', ['name' => 'title', 'value' => $tag->title, 'show' => true])
                    
                    @can('admin')
                        <button type="button"
                        class="btn btn-success mt-2"><a href="{{route('tags.edit', $tag->id)}}">{{'Update'}}</a></button>
                    @endcan
                </form>
                
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
