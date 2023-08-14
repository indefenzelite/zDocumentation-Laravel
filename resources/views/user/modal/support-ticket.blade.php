
<div class="modal fade" id="supportModel" tabindex="-1" role="dialog" aria-labelledby="supportModelTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form class="modal-content" action="" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="supportModelTitle">Raise a new ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="icon-close"></i></span>
        </button>
        </div>
        <div class="modal-body"style="padding: 10px;">
          
                <div class="form-group">
                  <label for="subject">Subject</label>
                  <select class="form-control" name="subject">
                    <option value="0" >Select Subject</option>
                    {{-- @foreach(getSupportSubject() as $item)
                      <option value="{{$item['name']}}"@if ($item['name'] == "Purchase") selected @endif>{{$item['name']}}</option>
                    @endforeach --}}
                  </select>
                </div>

                <div class="form-group">
                  <label for="prioirty">Priority</label>
                  <select class="form-control"  name="priority">
                    <option value="0">Select Prioiry</option>
                    @foreach(getSupportPrioity() as $item)
                     <option value="{{$item['name']}}">{{$item['name']}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea class="form-control" name="message" id="message" rows="3">This is a message regarding an issue I've been experiencing with my product</textarea>
                </div>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

      </form>
    </div>
</div>