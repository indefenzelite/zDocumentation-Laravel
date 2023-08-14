<div class="side-slide" style="right: -100%;">
    <div class="filter">
        <div class="card-header d-flex justify-content-between" style="background-color: #1a237e">
            <h3 class="text-white">Filter</h3>
            <button type="button" class="close off-canvas text-white" data-type="close">
                <span aria-hidden="true">×</span>
        </button></div>
        <div class="card-body">
            <form action="{{ route('admin.paragraph-contents.index') }}" class="d-flex" method="GET" id="TableForm">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="">Group</label>
                        <select id="type" name="group" class="select2 form-control course-filter">
                            <option readonly value="">{{ __('Select Group') }}</option>
                            @foreach ($groups as $item)
                            <option value="{{ $item->id }}" {{ $item->id == request()->get('type') ? 'selected': ''}}>{{ $item->name }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" style="background-color: #1a237e; border: 1px solid #1a237e;">Apply Filter</button>
                        <a href="javascript:void(0);" data-url="{{ route('admin.paragraph-contents.index') }}" id="reset" type="button" class="btn btn-light ml-2">Reset</a>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>