<style>
    .select2-container{
        width: 175px !important;
    }
</style>
<div class="side-slide" style="right: -100%;">
    <div class="filter">
        <div class="card-header d-flex justify-content-between" style="background-color: #1a237e">
            <h5 class="text-white mt-2">Filter</h5>
            <button type="button" class="close off-canvas text-white" data-type="close">
                <span aria-hidden="true">×</span>
        </button></div>
        <div class="card-body">
            <form action="{{ route('admin.users.index',['role' => request()->get('role')]) }}" method="get" class="d-flex">
                <input type="hidden" name="role" value="{{ request()->get('role') }}">
                <div class="row">
                    <div class="col-12 form-group mb-4">
                        <label for="">Status</label>
                        <select class="form-control select2" name="status" id="">
                            <option aria-readonly="true" value=""> All Status</option>
                            @foreach($statuses as $key => $status)
                                <option value="{{ $key }}" @if(request()->has('status') && request()->get('status') == $key) selected @endif>{{ $status['label'] }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" style="background-color: #1a237e; border: 1px solid #1a237e;">Apply Filter</button>
                        <a href="<?php $_SERVER['PHP_SELF']; ?>" id= "reset" type="button" class="btn btn-light ml-2">Reset</a>
                    </div> 
                </div>
            </form>
        </div>
    </div>
</div>