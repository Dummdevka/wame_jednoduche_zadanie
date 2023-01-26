@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid py-4 w-100 d-flex align-items-center flex-column w-75">
            <h1>Thank you for registering!</h1> 
            <p>Now you have to confirm your email!</p>
            {{-- <button class="btn btn-primary"><a href="{{route('home')}}">Go home</a></button> --}}
        </div>
        @include('layouts.footers.auth.footer')
    </div>
    
@endsection

