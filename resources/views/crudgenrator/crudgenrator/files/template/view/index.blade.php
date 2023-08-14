{{ $data['atsign'] }}extends('layouts.main')
{{ $data['atsign'] }}section('title', '{{ $indexheading }}')
{{ $data['atsign'] }}section('content')
{{ $data['atsign'] }}php
/**
* {{ $heading }}
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
        ['name'=>'{{ $indexheading }}', 'url'=> "javascript:void(0);", 'class' => 'active']
        ]
        {{ $data['atsign'] }}endphp
        <!-- push external head elements to head -->
        {{ $data['atsign'] }}push('head')
        <link rel="stylesheet"
            href="{{ $data['curlstart'] }} asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
        {{ $data['atsign'] }}endpush

        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-grid bg-blue"></i>
                            <div class="d-inline">
                                <h5>{{ $indexheading }}</h5>
                                <span>{{ __('List of ') }}{{ $indexheading }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        {{ $data['atsign'] }}include("admin.include.breadcrumb")
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
                                <h3>{{ $indexheading }}</h3> @isset($data['softdelete'])
                                    <span><a href="javascript:void(0);" class="btn-link active records-type"
                                            data-value="All">All</a> | <a href="javascript:void(0);"
                                            class="btn-link records-type" data-value="Trash">Trash</a></span>
                                @endisset
                            </div>

                            <form
                                action="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'] . $data['view_name'] }}.index') }}"
                                method="GET" id="TableForm">
                                <input type="hidden" name="page"
                                    value="{{ $data['curlstart'] }} request()->get('page') }}">
                                <input type="hidden" name="trash"
                                    value="{{ $data['curlstart'] }} request()->get('trash') }}">
                                <input type="hidden" name="length"
                                    value="{{ $data['curlstart'] }} request()->get('length') }}">
                                <div class="d-flex justify-content-right">
                                    @if (!isset($data['date_filter']))
                                        {{ commentOutStart() }}
                                    @endif
                                    <div class="form-group mb-0 mr-2">
                                        <span>From</span>
                                        <label for=""><input type="date" name="from" class="form-control"
                                                value="{{ $data['curlstart'] }}request()->get('from')}}"></label>
                                    </div>
                                    <div class="form-group mb-0 mr-2">
                                        <span>To</span>
                                        <label for=""><input type="date" name="to" class="form-control"
                                                value="{{ $data['curlstart'] }}request()->get('to')}}"></label>
                                    </div>
                                    <button type="submit" class="btn btn-icon btn-sm mr-2 btn-outline-warning"
                                        title="Filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                                    <a href="javascript:void(0);" id="reset"
                                        data-url="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'] . $data['view_name'] }}.index') }}"
                                        class="btn btn-icon btn-sm btn-outline-danger mr-2" title="Reset"><i
                                            class="fa fa-redo" aria-hidden="true"></i></a>
                                    @if (!isset($data['date_filter']))
                                        {{ commentOutEnd() }}
                                    @endif
                                    <a href="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'] . $data['view_name'] }}.create') }}"
                                        class="btn btn-icon btn-sm btn-outline-primary"
                                        title="Add New {{ $heading }}"><i class="fa fa-plus"
                                            aria-hidden="true"></i></a>
                                    @isset($data['export_btn'])
                                        <a href="{{ $data['curlstart'] }} route('{{ $data['dotroutepath'] . $data['view_name'] }}.export') }}"
                                            class="btn btn-icon btn-sm btn-outline-success"
                                            title="Export {{ $heading }}"><i class="fa fa-download"
                                                aria-hidden="true"></i></a>
                                    @endisset
                                    @isset($data['import_btn'])
                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-secondary"
                                            id="import" title="Import {{ $heading }}"><i class="fa fa-upload"
                                                aria-hidden="true"></i></a>
                                    @endisset
                                </div>
                            </form>
                            <div class="">
                                <select name="action" class=" form-control select-action ml-2" id="action">
                                    <option value="">Select Action</option>
                                    @foreach ($data['fields']['name'] as $index => $item)
                                        @if ($data['fields']['input'][$index] == 'select')
                                            {{ $data['atsign'] }}php
                                            $arr = [{!! (string) $data['fields']['comment'][$index] !!}];
                                            {{ $data['atsign'] }}endphp
                                            {{ $data['atsign'] }}foreach(getSelectValues($arr) as $key => $option)
                                            <option value="{{ $item }}-{{ $data['curlstart'] }}$option }}">
                                                {{ $data['curlstart'] }} $option }}</option>
                                            {{ $data['atsign'] }}endforeach
                                        @elseif($data['fields']['input'][$index] == 'checkbox' || $data['fields']['input'][$index] == 'radio')
                                            <option value="{{ $item }}-1">{{ $item }}</option>
                                            <option value="{{ $item }}-0">Not {{ $item }}</option>
                                        @endif
                                    @endforeach @isset($data['softdelete'])
                                    <option value="Restore"
                                        class="trash-option {{ $data['atsign'] }}if(request()->get('trash') != 1)  d-none {{ $data['atsign'] }}endif">
                                        Restore</option>
                                    <option value="Move To Trash"
                                        class="trash-option {{ $data['atsign'] }}if(request()->get('trash') == 1)  d-none {{ $data['atsign'] }}endif">
                                        Move To Trash</option>
                                @else
                                    <option value="Move To Trash">Move To Trash</option>
                                @endisset
                                <option value="Delete Permanently">Delete Permanently</option>
                                <option value="Export">Export</option>
                            </select>
                        </div>
                    </div>
                    <div id="ajax-container">
                        {{ $data['atsign'] }}include('{{ $data['dotviewpath'] }}{{ $data['view_name'] }}.load')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @isset($data['import_btn'])
        <!-- Modal -->
        <div class="modal fade" id="importXlsx" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import {{ $indexheading }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="ajax-modal-message"></div>
                        <form action="" id="ImportForm" method="post" enctype="multipart/form-data">
                            {{ $data['atsign'] }}csrf
                            <input type="hidden" name="request_with" value="upload">
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0);" class="btn btn-link excel-template" download=""><i
                                        class="ik ik-arrow-down"></i> Download Template</a>
                            </div>
                            <div class="form-group">
                                <label for="">Upload Updated Excel Template</label>
                                <input reuired type="file" class="form-control" name="file"
                                    accept=".xlsx,.xls,.csv">
                                <small>If template is not present use export file as a format.</small>
                            </div>
                            <div class="ajax-modal-message"></div>
                            <button type="submit" class="btn btn-primary" id="import-btn">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    <!-- push external js -->
    {{ $data['atsign'] }}push('script')
    <script src="{{ $data['curlstart'] }} asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ $data['curlstart'] }} asset('admin/js/index-page.js') }}"></script>
    {{ $data['atsign'] }}include('admin.include.more-action',['actionUrl'=>
    "{{ $data['slashroutepath'] }}{{ strtolower($data['view_name']) }}",'routeClass'=>"{{ strtolower($data['view_name']) }}"])
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <{{ $data['script'] }}>

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
        XLSX.writeFile(file, '{{ $data['model'] }}File.' + type);
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

        @isset($data['import_btn'])
            let ajaxMessageModal = ".ajax-modal-message";
            $('#import').click(function(){
            $('#importXlsx').modal('show');
            });

            $('#import-btn').click(function(e){
            e.preventDefault();
            let formdata = new FormData($('#ImportForm')[0]);
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            formdata.append("request_with", 'import');

            $.ajax({
            url: "{{ $data['curlstart'] }} route('{{ $data['dotroutepath'] . $data['view_name'] }}.import') }}",
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: function () {
            $(ajaxMessageModal).html(
            '<div class="alert alert-info"><i class="fa fa-refresh fa-spin"></i> Please wait... </div>'
            );
            },
            success: function (res) {
            $(ajaxMessageModal).html('<div class="alert alert-success">' + res.message +
                '</div>');
            page = '';
            fetch_data();
            setTimeout(function () {
            $("#importCSV").modal('hide');
            },5000);
            },
            complete: function () {
            $(this).find('[type=submit]').removeAttr('disabled');
            setTimeout(function () {
            $(ajaxMessageModal).html('');
            },5000);
            },
            error: function (data) {
            let response = JSON.parse(data.responseText);
            if (data.status === 400) {
            let errorString = '<ul>';
                $.each(response.errors, function (key, value) {
                errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';
            response = errorString;
            }

            if (data.status === 401)
            response = response.error;
            $(ajaxMessageModal).html('<div class="alert alert-danger">' + response +
                '</div>');
            }
            });
            });
        @endisset


        </{{ $data['script'] }}>
        {{ $data['atsign'] }}endpush
        {{ $data['atsign'] }}endsection
