
@extends('layouts.main') 
@section('title', 'Create CRUD')
@section('content')
@php
$breadcrumb_arr = [
    ['name'=> ' ', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
   
@push('head')
    <style>
        .btn:focus{
            box-shadow: none;
        }
    </style>
@endpush
    <div class="container-fluid">
    	<div class="page-header mb-0">   
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-header-title">
                        <div class="d-flex justify-content-between">
                            <h5>{{ __('Create CRUD')}}</h5>
                            <nav class="breadcrumb-container" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard.index')}}" target="_blank">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Create CRUD</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ik ik-x"></i>
                        </button>
                
                    </div>
                @endif 
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ik ik-x"></i>
                        </button>
                
                    </div>
                @endif 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                <form action="">
                    <div class="card ">
                        <div class="card-header">
                            <h3>{{ __('CRUD Details')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">                                    
                                <div class="col-12 col-md">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">Model Name <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('model') }}" class="form-control first-upper model_name" name="model" id="model_name" placeholder="Model Name" requireds>
                                        <small class="text-muted">Enter model name for the crud e.g: <span class="text-accent">UserContact</span> (<span class="text-danger">Name needs to be in singular</span>)</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">Table Name <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('name') }}" class="form-control lower crud_name" name="name" id="name" placeholder="Table Name" requireds>
                                        <small class="text-muted">Enter name for the crud e.g: <span class="text-accent">user_contacts</span> (<span class="text-danger">Name needs to be in plural</span>)</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md">
                                    <div class="form-group">
                                        <label for="">Menu Icon<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="menu_icon">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                               <div class="col-6">
                                    <label for="">Form Splits in 2 parts i.e. Left/Right</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Left Column</label>
                                            <input type="number" name="left_col" value="8" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Right Column <small>(having save btn)</small></label>
                                            <input type="number" name="right_col" value="4" class="form-control">
                                        </div>
                                    </div>
                               </div>
                               <div class="col-6">
                                    <label for="">Add Card in both Columns</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Left Card Group</label>
                                            <input type="number" name="left_card" value="1" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Right Card Group <small>(having save btn)</small></label>
                                            <input type="number" name="right_card" value="1" class="form-control">
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <label for="">Under In Modules:</label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Admin CRUD</span>
                                    </label>
                                    <label for=""><span class="" title="resources/views/admin"><i class="fa fa-info-circle"></i> View Path</span></label>
                                    <label for=""><span class="" title="App\Http\Controllers\Admin"> <i class="fa fa-info-circle"></i> Controllers Path</span></label>
                                    <label for=""><span class="" title="admin.php"> <i class="fa fa-info-circle"></i> Routes </span></label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" ><span class="checkbox-label">User CRUD</span>
                                    </label>
                                    <label for=""><span class="" title="resources/views/user"><i class="fa fa-info-circle"></i> View Path</span></label>
                                    <label for=""><span class="" title="App\Http\Controllers\User"> <i class="fa fa-info-circle"></i> Controllers Path</span></label>
                                    <label for=""><span class="" title="user.php"> <i class="fa fa-info-circle"></i> Routes </span></label>
                                </div>
                                <div class="col-12 col-md-12 my-2">
                                    <label for="">CRUD Addons:</label>
                                    <label class="form-check-label" for="softdelete"><input type="checkbox" id="softdelete" name="softdelete" value="1" @if(old('softdelete') == 1) checked @endif /><span class="checkbox-label"> Soft Delete</span></label>
                                    <label class="form-check-label" for="api"><input type="checkbox" id="api" name="api" value="1" @if(old('api') == 1) checked @endif /><span class="checkbox-label"> Generate API</span></label>
                                    <label class="form-check-label" for="date_filter"><input type="checkbox" id="date_filter" name="date_filter" value="1" checked /><span class="checkbox-label"> Date Filter</span></label>
                                    <label class="form-check-label" for="mail"><input type="checkbox" id="mail" name="mail" value="1" @if(old('mail') == 1) checked @endif /><span class="checkbox-label"> Mail Notification</span></label>
                                    <label class="form-check-label" for="notification"><input type="checkbox" id="notification" name="notification" value="1"@if(old('notification') == 1) checked @endif  /><span class="checkbox-label"> Site Notification</span></label>
                                    <label class="form-check-label" for="excel_btn"><input type="checkbox" id="excel_btn" name="excel_btn" value="1"@if(old('excel_btn') == 1) checked @endif  /><span class="checkbox-label"> Excel </span></label>
                                    <label class="form-check-label" for="print_btn"><input type="checkbox" id="print_btn" name="print_btn" value="1"@if(old('print_btn') == 1) checked @endif  /><span class="checkbox-label"> Print</span></label>
                                
                                </div>
                                <div class="col-12 col-md-12">
                                    <label for="">Form Options:</label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Create form</span>
                                    </label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Edit form</span>
                                    </label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Show page</span>
                                    </label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Delete action</span>
                                    </label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Multi-delete action</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Fields')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="">&nbsp;</th>
                                            <th>Field Type</th>
                                            <th>Database Column</th>
                                            <th>Visual Title</th>
                                            <th>In List</th>
                                            <th>In Create</th>
                                            <th>In Edit</th>
                                            <th>In Show</th>
                                            <th>Is Sortable</th>
                                            <th>Required</th>
                                            <th>Nullable</th>
                                            <th>Unique</th>
                                            <th>Multi Action</th>
                                            <th>Export</th>
                                            <th>Import</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable">
                                        <tr >
                                            <td class="field-handle-column">
                                                {{-- <span class="btn btn-info text-white"> #</span> --}}
                                            </td>
                                            <td>auto_increment</td>
                                            <td>id</td>
                                            <td>ID</td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td  class="field-handle-column">
                                                {{-- <span class="btn btn-info text-white"> #</span> --}}
                                            </td>
                                            <td>datetime</td>
                                            <td>created_at</td>
                                            <td>Created at</td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >
                                                {{-- <span class="btn btn-info text-white"> #</span> --}}
                                            </td>
                                            <td>datetime</td>
                                            <td>updated_at</td>
                                            <td>updated at</td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                          
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="softdelete d-none">
                                            <td >
                                                {{-- <span class="btn btn-info text-white"> #</span> --}}
                                            </td>
                                            <td>datetime</td>
                                            <td>deleted_at</td>
                                            <td>deleted at</td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button data-toggle="modal" data-target="#createModule" class="btn btn-info btn-block" type="button"><i class="fa fa-plus"></i>Add new field</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Table')}}</h3>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                    <div class="">
                        <a class="btn btn-default float-right" href="">Cancel</a>
                        <button class="btn btn-primary float-right" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('crudgenrator.module-fields')
    <!-- push external js -->
    @push('script')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $('#softdelete').on('click', function(){
            if($(this).prop('checked') == true)
            $('.softdelete').removeClass('d-none');
            else
            $('.softdelete').addClass('d-none');
        })
        function selectRefresh() {
            $('.select2').select2({
                //-^^^^^^^^--- update here
                tags: true,
                placeholder: "Select an Option",
                allowClear: true,
                width: '100%'
            });
        }
        $(document).ready(function() {
                $('.select2').each(function () {
                    $(this).select2()
                });
            });
        $( "#sortable" ).sortable({
            handle: "td.field-handle-column",
            placeholder: "ui-state-highlight"
        });
    </script>
    @endpush
@endsection
 

