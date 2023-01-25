@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => $title])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <div class="d-flex w-100">
                    @foreach($statuses as $status)
                        @include('components.filterbtn', ['filter' => $status])
                    @endforeach
                </div>
                @can('admin')
                    @include('pages.table', [
                        // 'image' => [
                        //     'target' => 1,
                        //     'url' => 'avatar.small'
                        // ],
                        'controls' => true,
                        'ssr' => false,
                        'color' => '#F7965F',
                        'dataRoute' => 'projects.data',
                        'deleteRoute' => 'projects.destroy',
                        'createRoute' => 'projects.create',
                        'updateRoute' => 'projects.show',
                        'order' => 2,
                        'fields' => [
                            'id' => 'ID',
                            'name' => 'Title',
                            'deadline' => 'Deadline',
                            'status' => 'Status',
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
                        'dataRoute' => 'projects.data',
                        'order' => 2,
                        'fields' => [
                            'id' => 'ID',
                            'name' => 'Title',
                            'deadline' => 'Deadline',
                            'status' => 'Status',
                            '' => ''
                        ]
                    ])
                @endcan
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
