<div class="side-slide" style="right: -100%;">
    <div class="filter">
        <div class="card-header d-flex justify-content-between" style="background-color: #1a237e">
            <h5 class="text-white mt-2">Filter</h5>
            <button type="button" class="close off-canvas text-white" data-type="close">
                <span aria-hidden="true">×</span>
        </button></div>
        <div class="card-body">
            <form action="{{route('admin.news-letters.index')}}" class="d-flex" method="GET" id="TableForm">
                <input type="hidden" name="ids" id="bulk_ids">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Type</label>
                        <select required name="type" class="form-control select2"style="width: 114px;"> 
                            <option value=""> Select Type</option> 
                            <option value="1">{{ 'Email' }}</option> 
                            <option value="2">{{ 'Number' }}</option> 
                        </select>
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