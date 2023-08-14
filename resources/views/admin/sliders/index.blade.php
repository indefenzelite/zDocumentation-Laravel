@extends('layouts.main') 
@section('title', $label)
@section('content')
    @php
    $breadcrumb_arr = [
        ['name'=>'Slider Group', 'url'=> route('admin.slider-types.index'), 'class' => 'active'],
        ['name'=>$label, 'url'=> "javascript:void(0);", 'class' => 'active']
    ]
    @endphp
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{$label}}</h5>
                            <span>List of Sliders @if(request()->get('sliderTypeId')) of  {{ $sliderType->title ?? '' }}@endif</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("admin.include.breadcrumb")
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>{{ $sliderType->title ?? '' }}</h3>
                        <div class="d-flex">
                            <a href="{{ route('admin.sliders.create',['sliderTypeId'=>request()->get('sliderTypeId')]) }}" class="btn btn-icon btn-sm btn-outline-primary mr-2" title="Add New Slider"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            <form action="{{route('admin.sliders.bulk-action')}}" method="POST"> 
                                @csrf
                                <input type="hidden" name="ids" id="bulk_ids">
                                <button style="background: transparent;border:none;" class="dropdown-toggle p-0 three-dots" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-more-vertical pl-1"></i></button>
                                <ul class="dropdown-menu multi-level" role="menu"      aria-labelledby="dropdownMenu">
                                    <button type="submit" 
                                        class="dropdown-item bulk-action text-danger fw-700"  
                                        data-value="" 
                                        data-message="You want to delete these items?" 
                                        data-action="delete" 
                                        data-callback="bulkDeleteCallback"> Bulk Delete
                                    </button>

                                    <a href="javascript:void(0)" 
                                        class="dropdown-item bulk-action"      
                                        data-value="0" 
                                        data-status="Unpublish" 
                                        data-column="status" 
                                        data-message="You want to mark Unpublish these items?" data-action="columnUpdate" data-callback="bulkColumnUpdateCallback">Mark as Unpublish
                                    </a>

                                    <a href="javascript:void(0)" 
                                        class="dropdown-item bulk-action"
                                        data-value="1" 
                                        data-status="Publish" 
                                        data-column="status" 
                                        data-message="You want to mark Publish these items?" data-action="columnUpdate" data-callback="bulkColumnUpdateCallback">Mark as Publish
                                    </a>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div id="ajax-container">
                        @include('admin.sliders.load')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    @include('admin.include.bulk-script')
    <script src="{{ asset('admin/js/index-page.js') }}"></script>
    {{-- START HTML TO EXCEL INIT --}}
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script>
            function html_table_to_excel(type)
                {
                    var table_core = $("#sliderTable").clone();
                    var clonedTable = $("#sliderTable").clone();
                    clonedTable.find('[class*="no-export"]').remove();
                    clonedTable.find('[class*="d-none"]').remove();
                    $("#sliderTable").html(clonedTable.html());
                    var data = document.getElementById('sliderTable');

                    var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
                    XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
                    XLSX.writeFile(file, 'SliderFile.' + type);
                    $("#sliderTable").html(table_core.html());
                }

                $(document).on('click','#export_button',function(){
                    html_table_to_excel('xlsx');
                });
        </script>
        {{-- END HTML TO EXCEL INIT --}}
    @endpush
