@push('css')

<style>
     td:hover {
        cursor: pointer;
    }
    .dataTables_info {
        font-size: .8125rem;
    }
    .select-info {
        display: none;
    }
    table.dataTable tbody > tr.selected, table.dataTable tbody > tr > .selected { background-color: {{ $color }} }
    /* header checkbox */
    table.dataTable thead th.select-checkbox,table.dataTable thead th.select-checkbox{position:relative}table.dataTable thead th.select-checkbox:before,table.dataTable thead th.select-checkbox:after,table.dataTable thead th.select-checkbox:before,table.dataTable thead th.select-checkbox:after{display:block;position:absolute;top:1.2em;left:50%;width:16px;height:16px;box-sizing:border-box}table.dataTable thead th.select-checkbox:before,table.dataTable thead th.select-checkbox:before{content:' ';margin-top:0px;margin-left:-8px;border:1px solid {{ $color }};border-radius:3px}table.dataTable thead tr.selected th.select-checkbox:before,table.dataTable thead tr.selected th.select-checkbox:before{background-color: {{ $color }}}table.dataTable tr.selected th.select-checkbox:after,table.dataTable thead tr.selected th.select-checkbox:after{content:'\2714';margin-top:-1px;margin-left:-7px;text-align:center; color: white}

    /* body checkbox */
    table.dataTable tbody td.select-checkbox,table.dataTable tbody th.select-checkbox{position:relative}table.dataTable tbody td.select-checkbox:before,table.dataTable tbody td.select-checkbox:after,table.dataTable tbody th.select-checkbox:before,table.dataTable tbody th.select-checkbox:after{display:block;position:absolute;top:1.2em;left:50%;width:16px;height:16px;box-sizing:border-box}table.dataTable tbody td.select-checkbox:before,table.dataTable tbody th.select-checkbox:before{content:' ';margin-top:2px;margin-left:-8px;border:1px solid {{ $color }};border-radius:3px}table.dataTable tr.selected td.select-checkbox:after,table.dataTable tbody tr.selected th.select-checkbox:after{content:'\2714';margin-top:-1px;margin-left:-7px;text-align:center;}
</style>

@endpush
<div class="d-fle-inline">
    @if(isset($createRoute))
        <a href="{{route($createRoute)}}"><button class="btn btn-primary col-2">Add</button></a>
    @endif
    {{-- @if(isset($deleteRoute))
        <button class="btn btn-danger col-2 ml-3" id="btn-del">Delete</button>
    @endif --}}
</div>

<table id="sphereTable" class="table table-striped table-bordered table-hover pointer"></table>

@push('js')
    <script>
        $(function(){
            //Turn off the error messages
            $.fn.dataTable.ext.errMode = 'none';

            var table = $('#sphereTable').DataTable({
                @if($ssr)
                    processing: true,
                    serverSide: true,
                @endif
                ajax: {
                    @if(isset($dataRouteId))
                    url: "{{ route($dataRoute, $dataRouteId) }}",
                    @else
                    url: "{{ route($dataRoute) }}" + location.search,
                    @endif
                    dataType: 'json',
                    type: 'GET',
                    data: { _token: "{{ csrf_token() }}" }
                },
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>Btrip",//'lfBtrip'
                //deferLoading: 10,
                columnDefs: [
                    @if(isset($image))
                        {
                            targets : {{ $image['target'] }} ,
                            width: "3%",
                            orderable: false,
                            searcheable: false,
                            render : function (image) {
                                if (typeof(image) == "string" && image.length > 1) {
                                    return '<img src="' + image + '" class="avatar rounded"/>';
                                }
                                else if ( image && image[0]) {
                                    return '<img src="' + image + '" class="avatar rounded"/>';
                                }
                                else {
                                    return '<i class="ni ni-fat-remove text-primary img-filler"></i>';
                                }
                            }
                        },
                    @endif
                    @if(isset($deleteRoute))
                        {
                            targets : -1 ,
                            width: "3%",
                            orderable: false,
                            searcheable: false,
                            render : function (datum, type, row) {
                                let str = '<button class="btn btn-danger" data-id="' + row.id + '" id="deleteBtn">Delete</button>'; 
                                @if(isset($btns))
                                    @foreach($btns as $btn)
                                        str += "<a href='{{route($btn['href'])}}" + '/' + row.id + "'><button class='btn btn-warning mr-2' data-id='" + row.id + "' id='{{$btn['btn_id']}}'>{{$btn['text']}}</button>"; 
                                    @endforeach
                                @endif
                                return str;
                            }
                        },
                    @endif
                ],
                select: {
                    style:    'multi',
                    selector: 'td:first-child'
                },
                order: [[ 1, 'desc' ]],
                columns: [
                    //null,
                    // {
                    //     title: 'SELECT',
                    //     data: 'id',
                    //     checkboxes: {
                    //         'selectRow': true,
                    //         'selectAll': false
                    //     }
                    // },
                    @foreach($fields as $key=>$name)
                    {
                        data: "{{ $key }}",
                        title: "{{ $name }}",
                        @if($key == 'image')
                            width: "3%",
                        @endif
                        @if($key == 'id' && isset($include))
                            render : function (id) {
                                return '{!! $include !!}'.replaceAll('!!id!!', id)
                        }
                        @endif
                    },
                    @endforeach
                ],
                autoWidth: false
            });

            table.on( 'error.dt', function(e, settings, techNote, message) {
                console.log(message);
            });

            setTimeout(function() {
                $('.dt-buttons').removeClass('btn-group');
                $('.dt-buttons').addClass(['d-flex', 'justify-content-between']);

            }, 0);


            // //Селект ров
            // $('#sphereTable tbody').on('click', 'td.select-checkbox', function (e) {
            //     //var data = table.row(this).data();
            //     headerCheckboxCheck();
            // } );

            //Delete
            @if(isset($deleteRoute))
                $('#sphereTable tbody').on('click', 'td button#deleteBtn', function(e) {
                    let url = '{{route($deleteRoute, ":id")}}';
                    const id = e.target.dataset.id;
                    url = url.replace(':id', id);

                    let ajxReq = $.ajax( 
                        url,
                        {
                            type : 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }
                    );

                    table.ajax.reload();
                });
            @endif

            @if(isset($updateRoute))
                $('#sphereTable tbody').on('click', 'td', function (e) {
                    //var data = table.row(this).data();
                    console.log(e.target);
                    if (!e.target.classList.contains('select-checkbox') && !e.target.classList.contains('btn') && e.target.tagName != "button") {
                        let url = '{{ route($updateRoute, ":id")}}';
                        let id = table.row(this).data().id;
                        url = url.replace(':id', id);
                        window.location.href = url;
                    }
                } );
            @endif

            $('table.dataTable thead').on('click', 'th.select-checkbox', function(e) {

                headerCheckboxCheck();

                const header_checkbox = e.target.parentNode.classList;
                if (header_checkbox.contains('selected')) {
                    $('.delete').addClass('invisible');
                    header_checkbox.remove('selected');
                    table.rows( { selected: true } ).deselect();
                }
                else {
                    table.rows( { selected: false } ).select();
                    $('.delete').removeClass('invisible');
                    header_checkbox.add('selected');
                }


            });

            // @if(isset($deleteAjax))
            //     //Удаление по чекбоксу
            //     $('#btn-del').on('click', function(e) {
            //         let rows_selected = table.column(0).checkboxes.selected();

            //         $.each(rows_selected, function(index, rowId){
            //             let url = '{{ route($deleteAjax) }}/' + rowId;
            //             console.log(rowId);
            //             let ajxReq = $.ajax( 
            //                 url,
            //                 {
            //                     type : 'DELETE',
            //                     data: {
            //                         "_token": "{{ csrf_token() }}"
            //                     }
            //                 }
            //             );

            //             ajxReq.then(function(data) {
            //                 console.log('deleted');
            //             });
            //         })
            //         table.ajax.reload();
            //         // window.location.reload();
            //     });
            // @endif

            function headerCheckboxCheck() {
                setTimeout(function() {
                    const selected = table.rows( { selected: true } ).count();

                    if (selected == 0) {
                        $('th.select-checkbox').parent().removeClass('selected');
                        $('.delete').addClass('invisible');
                    }
                    else {
                        $('th.select-checkbox').parent().addClass('selected');
                        $('.delete').removeClass('invisible');
                    }

                }, 0);
            }

            // setInterval(() => {
            //     table.ajax.reload()
            // }, 10000);
    })
    </script>
@endpush
