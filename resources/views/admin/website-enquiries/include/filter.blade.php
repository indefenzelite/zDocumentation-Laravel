<div class="side-slide" style="right: -100%;">
    <div class="filter">
        <div class="card-header d-flex justify-content-between" style="background-color: #1a237e">
            <h5 class="text-white mt-2">Filter</h5>
            <button type="button" class="close off-canvas text-white" data-type="close">
                <span aria-hidden="true">×</span>
        </button></div>
        <div class="card-body">
            <form class="d-flex" action="{{route('admin.website-enquiries.index')}}" method="get" id="TableForm">  
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control select2">
                            <option value="" readonly>All Status</option>    
                                @foreach ($statuses as $key => $status)
                                    <option value="{{$key}}" @if (request()->has('status') && $key == request()->get('status')) selected @endif>{{$status['label']}}</option>    
                                @endforeach
                        </select> 
                    </div> 
                    <div class="form-group col-12">
                        <label for="">From</label>
                        <input type="date" name="from" class="form-control" value="{{request()->get('from')}}">
                    </div>
                    <div class="form-group col-12"> 
                        <label for="">To</label> 
                        <input type="date" name="to" class="form-control" value="{{ request()->get('to')}}">
                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" style="background-color: #1a237e; border: 1px solid #1a237e;">Apply Filter</button>
                        <a href="javascript:void(0);" id="reset" type="button" class="btn btn-light ml-2">Reset</a>
                    </div> 
                </div>
            </form>
        </div>
    </div>
</div>