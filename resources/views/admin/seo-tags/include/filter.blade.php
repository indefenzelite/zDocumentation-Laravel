<div class="side-slide" style="right: -100%;">
    <div class="filter">
        <div class="card-header d-flex justify-content-between" style="background-color: #1a237e">
            <h5 class="text-white mt-2">Filter</h5>
            <button type="button" class="close off-canvas text-white" data-type="close">
                <span aria-hidden="true">×</span>
        </button></div>
        <div class="card-body">
            <form action="" class="d-flex" method="GET" id="TableForm">
                <div class="row">
                    <div class="col-12">
                        <label for="">From</label>
                        <input type="date" name="from" class="form-control mx-1" value="{{request()->get('from')}}">
                    </div>
                    <div class="col-12 mt-3"> 
                        <label for="">To</label>
                        <input type="date" name="to" class="form-control mx-1" value="{{request()->get('from')}}">
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary" style="background-color: #1a237e; border: 1px solid #1a237e;">Apply Filter</button>
                        <a href="javascript:void(0);" id="reset" type="button" class="btn btn-light ml-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>