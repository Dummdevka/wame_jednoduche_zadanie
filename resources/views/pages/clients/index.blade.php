@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => $title])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
            @can('admin')
                @include('pages.table', [
                    // 'image' => [
                    //     'target' => 1,
                    //     'url' => 'avatar.small'
                    // ],
                    'controls' => true,
                    'ssr' => false,
                    'color' => '#F7965F',
                    'dataRoute' => 'clients.data',
                    // 'dataRouteId' => ['user_id' => $user->id],
                    'deleteRoute' => 'clients.destroy',
                    'createRoute' => 'clients.create',
                    'updateRoute' => 'clients.update',
                    // 'deleteAjax' => 'users.ajaxdelete',
                    'order' => 2,
                    'fields' => [
                        'id' => 'ID',
                        'name' => 'Name',
                        'email' => 'Email',
                        'company_name' => 'Company name',
                        '' => ''
                    ]
                ])
            @endcan
            @can('user')
                @include('pages.table', [
                    // 'image' => [
                    //     'target' => 1,
                    //     'url' => 'avatar.small'
                    // ],
                    'controls' => true,
                    'ssr' => false,
                    'color' => '#F7965F',
                    'dataRoute' => 'clients.data',
                    'order' => 2,
                    'fields' => [
                        'id' => 'ID',
                        'name' => 'Name',
                        'email' => 'Email',
                        'company_name' => 'Company name',
                        '' => ''
                    ]
                ])
            @endcan
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
