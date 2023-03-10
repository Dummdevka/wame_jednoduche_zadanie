@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => $title])
    <div class="container-fluid mt--7 fluid-bg">
        <div class="col-md-12">
            <div class="card p-3 fit-content">
                <div class="d-flex w-100">
                    @foreach($tags as $tag)
                        @include('components.filterbtn', ['filter' => $tag])
                    @endforeach
                    @include('components.filterbtn', ['filter' => 'My&id=' . auth()->user()->id, 'label' => 'My tasks']) 
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
                    'dataRoute' => 'tasks.data',
                    'deleteRoute' => 'tasks.destroy',
                    'createRoute' => 'tasks.create',
                    'updateRoute' => 'tasks.show',
                    'order' => 2,
                    'fields' => [
                        'id' => 'ID',
                        'title' => 'Title',
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
                    'dataRoute' => 'tasks.data',
                    'updateRoute' => 'tasks.show',
                    'order' => 2,
                    'fields' => [
                        'id' => 'ID',
                        'title' => 'Title',
                        '' => ''
                    ]
                ])
            @endcan
            </div>
        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
