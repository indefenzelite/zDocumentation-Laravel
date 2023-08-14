@extends('layouts.main')
@section('title', $label)
@section('content')
    @php
        if ($category->level == 1) {
            $page_title = 'Categories';
            $arr = null;
        } elseif ($category->level == 2) {
            $page_title = 'Sub Categories';
            $arr = ['name' => $parent->name, 'url' => route('admin.categories.index', $category->category_type_id), 'class' => ''];
        } elseif ($category->level == 3) {
            $page_title = 'Sub Sub Categories';
            $pre = $category->parent_id - 1;
            $arr = ['name' => $parent->name, 'url' => route('admin.categories.index', [$category->category_type_id, 'level' => '2', 'parent_id' => $pre]), 'class' => ''];
        }
        $breadcrumb_arr = [
            ['name' => $categoryType->name ?? '--', 'url' => route('admin.category-types.index'), 'class' => 'active'],
            $arr,
            // ,
            ['name' => $label, 'url' => 'javascript:void(0);', 'class' => 'active'],
        ];
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
                            <h5>{{ __('Edit') }} {{ $label }}</h5>
                            <span>{{ __('Update a record for') }} {{ $label }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            <!-- end message area-->
            <div class="col-md-8 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Update') }} {{ $label }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden"name="request_with" value="update">
                            <input type="hidden"name="parent_id" value="{{ request()->get('parent_id') }}">
                            <div class="row">
                                <div class="col-md-12 mx-auto">
                                    <div class="row d-none">
                                        <div class="col-sm-6">
                                            <div
                                                class="form-group {{ $errors->has('category_type_id') ? 'has-error' : '' }}">
                                                <label for="category_type_id">{{ __('Category Type') }}</label>
                                                {!! getHelp('Publicly readable name') !!}
                                                <select name="category_type_id" id="category_type_id"
                                                    class="form-control select2">
                                                    <option value="" readonly required>
                                                        {{ __('Select Category Type') }}</option>
                                                    @foreach ($categoryTypes as $index => $categoryType)
                                                        <option value="{{ $categoryType->id }}"
                                                            {{ $categoryType->id == $category->category_type_id ? 'selected' : '' }}>
                                                            {{ $categoryType->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
                                                <label for="level">{{ __('level') }}</label>
                                                {!! getHelp('Publicly readable name') !!}
                                                <select name="level" id="level" class="form-control select2">
                                                    <option value="" readonly required>{{ __('Select Level') }}
                                                    </option>
                                                    @foreach ($types as $index => $item)
                                                        <option value="{{ $index }}"
                                                            {{ $index == $category->level ? 'selected' : '' }}>
                                                            {{ $item['label'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                <label for="name" class="control-label">{{ 'Name' }}</label>
                                                {!! getHelp('Sub Categories Name belong to parent Category') !!}
                                                <input class="form-control" name="name" type="text"
                                                    pattern="[a-zA-Z]+.*"
                                                    title="Please enter first letter alphabet and at least one alphabet character is required."
                                                    id="name" value="{{ $category->name }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="logo" class=" col-form-label">{{ __('Icon') }}</label>
                                                {!! getHelp('Icons for the Categories') !!}
                                                <div class="">
                                                    <div class="input-group col-xs-12">
                                                        <input type="file" name="icon" class="file-upload-default">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control file-upload-info"
                                                                disabled placeholder="Upload Icon">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-success"
                                                                    type="button">{{ __('Upload') }}</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary float-right">Save & Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
