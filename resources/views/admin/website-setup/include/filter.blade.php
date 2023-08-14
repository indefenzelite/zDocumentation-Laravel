<div class="side-slide" style="right: -100%;">
    <div class="filter">
        <div class="card-header d-flex justify-content-between" style="background-color: #1a237e">
            <h3 class="text-white">Filter</h3>
            <button type="button" class="close off-canvas text-white" data-type="close">
                <span aria-hidden="true">×</span>
        </button></div>
        <div class="card-body">
            <form action=""method="GET"   id="TableForm"class="d-flex">
                <div class="row">
                    <div class="col-12">
                        <label for="">From</label>
                        <input type="date" name="from" class="form-control" value="{{request()->get('from')}}">
                    </div>
                    <div class="col-12 mt-3"> 
                        <label for="">To</label>
                        <input type="date" name="to" class="form-control" value="{{request()->get('to')}}">
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary" style="background-color: #1a237e; border: 1px solid #1a237e;">Apply Filter</button>
                        <a href="{{ route('admin.seo-tags.index') }}" id="reset" type="button" class="btn btn-light ml-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>