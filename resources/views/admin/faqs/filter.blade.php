<div class="side-slide" style="right: -100%;">
    <div class="filter">
        <div class="card-header d-flex justify-content-between" style="background-color: #efefef">
            <h5 class="text-filter mt-2">Filter</h5>
            <button type="button" class="close off-canvas text-filter" data-type="close">
                <span aria-hidden="true">×</span>
        </button></div>
        <div class="card-body">
            <form action="{{ route('admin.faqs.index') }}" method="get">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label for="">Status</label>
                            <select name="category_id" id="" class="form-control select2">
                                <option value="" readonly>All Category</option>
                                @foreach (getCategoriesByCode('FaqCategories') as $category)
                                <option value="{{$category->id}}" @if($category->id == request()->get('category_id')) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" style="background-color: #06bf61; border: 1px solid #06bf61;">Apply Filter</button>
                        <a href="<?php $_SERVER['PHP_SELF']; ?>" id= "reset" type="button" class="btn btn-light ml-2">Reset</a>
                    </div> 
                </div>
            </form>
        </div>
    </div>
</div>