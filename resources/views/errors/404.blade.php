@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid py-4 w-100 d-flex align-items-center flex-column">
            <h1>Page not found</h1>
            <button class="btn btn-primary"><a href="{{route('home')}}">Go home</a></button>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
    
@endsection

