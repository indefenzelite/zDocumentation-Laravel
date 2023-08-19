@extends('layouts.main')
@section('title', 'Votes')
@section('content')
@php
/**
* Vote
*
* @category ZStarter
*
* @ref zCURD
* @author Defenzelite <hq@defenzelite.com>
    * @license https://www.defenzelite.com Defenzelite Private Limited
    * @version <zStarter: 1.1.0>
        * @link https://www.defenzelite.com
        */
        $breadcrumb_arr = [
        ['name'=>'Votes', 'url'=> "javascript:void(0);", 'class' => 'active']
        ]
        @endphp
        <!-- push external head elements to head -->
        @push('head')
        <link rel="stylesheet"
            href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
        @endpush

        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-grid bg-blue"></i>
                            <div class="d-inline">
                                <h5>Votes</h5>
                                <span>List of Votes</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @include("admin.include.breadcrumb")
                    </div>
                </div>
            </div>

            <div class="ajax-message text-center"></div>
            <div class="row">
                <!-- start message area-->
                <!-- end message area-->

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h3>Votes</h3>                                     <span>
                                        <a href="javascript:void(0);" class="btn-link active records-type"
                                            data-value="All">All</a> |
                                        <a href="javascript:void(0);" class="btn-link records-type"
                                            data-value="Trash">Trash</a>
                                    </span>
                                
                            </div>

                            <form
                                action="{{ route('admin.votes.index') }}"
                                method="GET" id="TableForm">
                                <input type="hidden" name="page"
                                    value="{{ request()->get('page') }}">
                                <input type="hidden" name="trash"
                                    value="{{ request()->get('trash') }}">
                                <input type="hidden" name="length"
                                    value="{{ request()->get('length') }}">
                                <div class="d-flex justify-content-right">
                                                                        <div class="form-group mb-0 mr-2">
                                        <span>From</span>
                                        <label for=""><input type="date" name="from" class="form-control"
                                                value="{{request()->get('from')}}"></label>
                                    </div>
                                    <div class="form-group mb-0 mr-2">
                                        <span>To</span>
                                        <label for=""><input type="date" name="to" class="form-control"
                                                value="{{request()->get('to')}}"></label>
                                    </div>
                                    <button type="submit" class="btn btn-icon btn-sm mr-2 btn-outline-warning"
                                        title="Filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                                    <a href="javascript:void(0);" id="reset"
                                        data-url="{{ route('admin.votes.index') }}"
                                        class="btn btn-icon btn-sm btn-outline-danger mr-2" title="Reset"><i
                                            class="fa fa-redo" aria-hidden="true"></i></a>
                                    
                                    @if(auth()->user()->isAbleTo('add_vote'))
                                    <a href="{{ route('admin.votes.create') }}"
                                        class="btn btn-icon btn-sm btn-outline-primary"
                                        title="Add New Vote"><i class="fa fa-plus"
                                            aria-hidden="true"></i></a>
                                    @endif  
                                </div>
                            </form>
                            @if($bulkActivation == 1)
                            <div class="">
                                <select name="action" class=" form-control select-action ml-2" id="action">
                                    <option value="">Select Action</option>
                                                                                                                                                                                                                                                                                                                                                                                         <option value="Restore"
                                        class="trash-option @if(request()->get('trash') != 1)  d-none @endif">
                                        Restore</option>
                                    <option value="Move To Trash"
                                        class="trash-option @if(request()->get('trash') == 1)  d-none @endif">
                                        Move To Trash</option>
                                
                                <option value="Delete Permanently">Delete Permanently</option>
                                <option value="Export">Export</option>
                            </select>
                        </div>
                        @endif
                    </div>
                    <div id="ajax-container">
                        @include('admin.votes.load')
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- push external js -->
    @push('script')
    <script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('admin/js/index-page.js') }}"></script>
    @include('admin.include.more-action',['actionUrl'=>
    "admin/votes",'routeClass'=>"votes"])
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>

        function html_table_to_excel(type)
        {
        let table_core = $("#table").clone();
        let clonedTable = $("#table").clone();
        clonedTable.find('[class*="no-export"]').remove();
        clonedTable.find('[class*="d-none"]').remove();
        $("#table").html(clonedTable.html());
        let data = document.getElementById('table');

        let file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
        XLSX.writeFile(file, 'VoteFile.' + type);
        $("#table").html(table_core.html());

        }

        $(document).on('click','#export_button',function(){
        html_table_to_excel('xlsx');
        })


        $('#reset').click(function(){
        let url = $(this).data('url');
        getData(url);
        window.history.pushState("", "", url);
        $('#TableForm').trigger("reset"); $(document).find('.close.off-canvas').trigger('click');
        // $('#fieldId').select2('val',""); // if you use any select2 in filtering uncomment this code
        // $('#fieldId').trigger('change'); // if you use any select2 in filtering uncomment this code
        });

        

        </script>
        @endpush
        @endsection
