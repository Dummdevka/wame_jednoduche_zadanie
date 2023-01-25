@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Show client'])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <form action="{{route('clients.store')}}" method="post" class="w-100 d-flex flex-column align-items-center">
                    @csrf
                    @include('components.input', ['name' => 'name', 'value' => $client->name, 'show' => true])
                    @include('components.input', ['name' => 'email', 'value' => $client->email, 'show' => true])
                    @include('components.input', ['name' => 'phone', 'value' => $client->phone, 'show' => true])
                    @include('components.input', ['name' => 'company_name', 'value' => $client->company_name, 'show' => true])
                    <div class="w-25">
                        <label for="self_employed" class="form-control-label">Self employe</label>
                        <input type="checkbox" name="self_employe" id="self_employe" value="{{$client->self_employed}}" disabled>
                    </div>
                    
                    @can('admin')
                        <button type="button"
                        class="btn btn-success mt-2"><a href="{{route('clients.edit', $client->id)}}">{{'Update'}}</a></button>
                    @endcan
                </form>
                
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
