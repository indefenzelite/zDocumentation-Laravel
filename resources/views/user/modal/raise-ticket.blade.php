<div class="modal fade" id="raise-ticket-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="">Raise Ticket</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                    <i class="uil uil-times fs-4 text-dark" style="display: inline !important;"></i>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" action="{{ route('user.support-ticket.store') }}">
                    @csrf   
                    <input type="hidden" name="request_with" value="create">
                    <div>
                        <label class="form-label">Subject</label>
                        <select required name="subject" id="subject" class="form-control select2">
                            <option value="">Select Subject</option>
                            <option value="General Support">General Support</option>
                           <option value="Facing problems using their system">Facing problems using their system</option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="prioirty">Priority</label>
                        <select class="form-control" name="prioirty">
                            <option value="0">Select Priority</option>
                            @foreach (getSupportPrioity() as $item)
                                <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="gender">{{ __('Priority')}}</label>
                        {!! getHelp('Importance for this suppot ticket') !!}
                        <div class="form-radio">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="priority" value="0">
                                    <i class="helper"></i>{{ __('Low')}}
                                </label>
                                <label>
                                    <input type="radio" name="priority" value="1"checked>
                                    <i class="helper"></i>{{ __('Medium')}}
                                </label>
                                <label>
                                    <input type="radio" name="priority" value="2">
                                    <i class="helper"></i>{{ __('High')}}
                                </label>
                            </div>
                            {{-- <div class="radio radio-inline">
                               
                            </div>
                            <div class="radio radio-inline">
                                
                            </div> --}}
                        </div>                                        
                        <div class="help-block with-errors"></div>
                    </div>

                    <div>
                        <label class="form-label">Message</label>
                        <textarea required placeholder="Explain your problem here..." name="message" class="form-control" id="message" rows="5"></textarea>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>