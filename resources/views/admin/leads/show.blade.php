@extends('layouts.main')
@section('title', 'Lead')
@section('content')

    @php
        $breadcrumb_arr = [['name' => 'Lead', 'url' => route('admin.leads.index'), 'class' => ''], ['name' => 'View Lead', 'url' => 'javascript:void(0);', 'class' => '']];
    @endphp

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ $lead->getPrefix() ?? '' }}</h5>
                            <span>{{ $lead->formatted_created_at ?? '' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-4">
                <div class="card ">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h5>{{ $lead->name ?? '' }}</h5>
                        <div>
                            <span class="badge badge-info mb-2">{{ $lead->leadType->name ?? '' }}</span>
                            <a href="{{route('admin.leads.edit',secureToken($lead->id))}}" class="ml-2 mb-0 text-primary" style="">
                                <span title="Edit Lead"><i class="fa fa-2x fa-edit"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-muted d-block">{{ __('Email Address') }} </div>
                        <h6>{{ $lead->owner_email ?? '--' }}</h6>
                        <div class="text-muted d-block pt-10">{{ __('Contact Phone') }}</div>
                        <h6>{{ $lead->phone ?? '--' }}</h6>
                        <div class="text-muted d-block pt-10">{{ __('Website') }}</div>
                        <h6>{{ $lead->website ?? '--' }}</h6>
                        <div class="text-muted d-block pt-10">{{ __('Lead Source') }}</div>
                        <h6>{{ $lead->source->name ?? '--' }}</h6>
                        <div class="text-muted d-block pt-10">{{ __('Location') }}</div>
                        <h6>
                            {{ $lead->address ?? '--' }}</h6>

                        <div class="text-muted d-block pt-10">{{ __('Remark') }}</div>
                        <h6>{{ $lead->remark ?? '--' }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-8">
                <div class="card">
                    <div class="card-body p-0">
                        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                            @if(auth()->user()->isAbleTo('view_notes'))
                                <li class="nav-item">
                                    <a data-active="note" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "note" || auth()->user()->isAbleTo('view_notes') && !request()->has('active')) active @endif" id="pills-setting-tab" data-toggle="pill" href="#previous-month"
                                        role="tab" aria-controls="pills-setting"
                                        aria-selected="false">{{ __('Lead Notes') }}</a>
                                </li>
                            @endif
                            @if(auth()->user()->isAbleTo('view_contacts'))
                                <li class="nav-item">
                                    <a data-active="contact" class="nav-link active-swicher @if(request()->has('active') && request()->get('active')  == "contact" || !auth()->user()->isAbleTo('view_notes') && auth()->user()->isAbleTo('view_contacts')) show active @endif" id="pills-timeline-tab" data-toggle="pill" href="#current-month"
                                        role="tab" aria-controls="pills-timeline"
                                        aria-selected="true">{{ __('Contact Peoples') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            @if(auth()->user()->isAbleTo('view_notes'))
                                <div class="tab-pane fade @if(request()->has('active') && request()->get('active') == "note" || auth()->user()->isAbleTo('view_notes') && !request()->has('active')) show active @endif" id="previous-month" role="tabpanel"
                                    aria-labelledby="pills-setting-tab">
                                    <div class="card-header p-3 d-flex justify-content-between align-items-center">
                                        <h3>{{ __('Notes') }}</h3>
                                        @if(auth()->user()->isAbleTo('add_note'))
                                            <a href="javacript:void(0);" class="btn btn-icon btn-sm btn-outline-primary"
                                                data-toggle="modal" data-target="#exampleModalCenter" title="Add New Note"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></a>
                                        @endif
                                    </div>
                                    @if(auth()->user()->isAbleTo('control_note'))
                                        <div class="card-body" style="overflow: auto">
                                            @include('admin.leads.includes.notes.index')
                                        </div>
                                    @endif
                                </div>
                            @endif
                            @if(auth()->user()->isAbleTo('view_contacts'))
                                <div class="tab-pane fade @if(request()->has('active') && request()->get('active') == "contact" || !auth()->user()->isAbleTo('view_notes') && auth()->user()->isAbleTo('view_contacts')) show active @endif" id="current-month" role="tabpanel"
                                    aria-labelledby="pills-timeline-tab">
                                    <div class="card-header p-3 d-flex justify-content-between align-items-center">
                                        <h3>{{ __('Contact') }}</h3>
                                        @if(auth()->user()->isAbleTo('add_contact'))
                                            <a href="javacript:void(0);" class="btn btn-icon btn-sm btn-outline-primary"
                                                data-toggle="modal" data-target="#ContactModalCenter" title="Add New Contact"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></a>
                                        @endif
                                    </div>
                                    @if(auth()->user()->isAbleTo('control_contact'))
                                        <div class="card-body">
                                            @include('admin.leads.includes.contacts.index')
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Custom Mail Start --}}
    <div class="modal fade" id="customMailModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="customMailModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:900px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customMailModalLongTitle">{{ __('Compose a new mail') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="user_selection">Send To</label>
                                    <select name="user_selection" id="user_selection" class="form-control">
                                        <option value="" aria-readonly="true">--Select User--</option>
                                        <option value="new">New Email ID</option>
                                        {{-- @foreach (UserList() as $users)
                                            <option value="{{ $users->email }}">{{ $users->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group" id="email-container">
                                    <label for="email">To</label>
                                    <textarea type="email"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required."class="form-control" name="email" id="email" placeholder="Email"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="cc">CC</label>
                                    <input type="email" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control" name="cc" id="cc"
                                        placeholder="CC Email">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bcc">BCC</label>
                                    <input type="email" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control" name="bcc" id="bcc"
                                        placeholder="BCC Email">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text"  pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control" name="subject" id="subject"
                                        placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-10">
                                <div class="form-group">
                                    <label for="attach">Attach</label>
                                    <select name="attach[]" id="attach" class="form-control" multiple>
                                        {{-- @foreach (UserList() as $user)
                                            <option value="{{ $user->email }}">{{ $user->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-2">
                                <div class="form-group mt-4">
                                    <button type="button" class="btn btn-primary" id="prepareMessage">Prepare
                                        Message</button>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control html-editor" rows="6" name="message" id="message" placeholder="Message"
                                        style="resize: none"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea class="form-control" required  rows="6" name="body" id="bodytextarea" placeholder="Body"
                                        style="resize: none"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"> <i class="ik ik-send"></i>
                                        Send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Custom Mail End --}}

    @include('admin.leads.includes.contacts.create')
    @include('admin.leads.includes.contacts.edit')
    @include('admin.leads.includes.notes.create')
    @include('admin.leads.includes.notes.edit')
    <!-- push external js -->
    @push('script')
    {{-- START CKEDITOR INIT --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
        <script>
            let editor;
            $(window).on('load', function (){
                ClassicEditor
                    .create( document.querySelector('.ck-editor'),{
                        ckfinder: {
                            uploadUrl: "{{route('admin.media.ckeditor.upload').'?_token='.csrf_token()}}",
                        }
                    })
                    .then( newEditor => {
                        editor = newEditor;
                    } )
                    .catch( error => {
                        
                    } );
            }); 
        </script>
    {{-- END CKEDITOR INIT --}}

    {{-- START JS HELPERS INIT --}}
        <script>
            $(document).ready(function() {
                $('#prepareMessage').on('click', function() {
                    var user_emails = $('#attach').val();
                    var url = "#";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            user_emails: user_emails
                        },
                        dataType: "html",
                        success: function(resultData) {
                            console.log(resultData);
                            // $('#bodytextarea').val();
                            // $( '#bodytextarea' ).val( resultData );
                            // $( '#bodytextarea' ).html( resultData );
                            CKEDITOR.instances['bodytextarea'].setData(resultData);
                            // $( 'textarea.body' ).val('');
                            // $('#body').html('');
                            // $("#body").html(resultData);
                        }
                    });
                });

                $('#email-container').hide();
                $(document).on('change', '#user_selection', function(e) {
                    var old_value = $('#email').val();
                    var email = e.target.value;
                    var emails;
                    if (old_value != '') {
                        emails = old_value + ',' + email;
                    } else {
                        emails = email;
                    }
                    if (email !== 'new') {
                        $('#email').val(emails);
                    } else {
                        $('#email').val('');
                    }

                    $('#email-container').fadeIn(250);
                    if (email == '') {
                        $('#email-container').fadeOut(250);
                    }
                });
            });
        </script>
        <script>
            $('.edit-note').each(function() {
                $(this).click(function() {
                    var data = $(this).data('item');
                    $('#note-type_id').val(data.type_id);
                    $('#note-title').val(data.title);
                    $('#note-description').val(data.description);
                    var url = "{{ url('/admin/user-notes/update') }}" + '/' + data.id;
                    $('#editNoteForm').attr('action', url);
                    $('#editModalCenter').modal('show');
                })
            });
            $('.edit-contact').each(function() {
                $(this).click(function() {
                    var contact = $(this).data('contact');
                    $('#edit_type_id').val(contact.type_id);
                    $('#edit_first_name').val(contact.first_name);
                    $('#edit_last_name').val(contact.last_name);
                    $('#edit_job_title').val(contact.job_title);
                    $('#edit_job_title').val(contact.job_title);
                    $('#edit_email').val(contact.email);
                    $('#edit_phone').val(contact.phone);
                    if (contact.gender == 'male') {
                        $('.male-radio').attr('checked',true)
                    } else {
                        $('.female-radio').attr('checked',true)
                    }
                    var url = "{{ url('/admin/contacts/update') }}" + '/' + contact.id;
                    $('#editContactForm').attr('action', url);
                    $('#editContact').modal('show');
                })
            });
            $(".edit-text").attr("readonly");
            $('.edit-btn').each(function() {
                $(this).click(function() {
                    $(".edit-text").attr("readonly");
                    $(this).parent().parent().parent().find($('.edit-text')).removeAttr('readonly');
                });
            });
            $(document).ready(function() {
                var table = $('.data_table').DataTable({
                    responsive: true,
                    fixedColumns: true,
                    fixedHeader: true,
                    scrollX: false,
                    'aoColumnDefs': [{
                        'bSortable': false,
                        'aTargets': ['nosort']
                    }],
                    dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
                    buttons: [{
                            extend: 'excel',
                            className: 'btn-sm btn-success',
                            header: true,
                            footer: true,
                            exportOptions: {
                                columns: ':visible',
                            }
                        },
                        'colvis',
                        {
                            extend: 'print',
                            className: 'btn-sm btn-primary',
                            header: true,
                            footer: false,
                            orientation: 'landscape',
                            exportOptions: {
                                columns: ':visible',
                                stripHtml: false
                            }
                        }
                    ]

                });
            });
            $('.active-swicher').on('click', function() {
                var active = $(this).attr('data-active');
                updateURL('active',active);
            });
        </script>
    {{-- END JS HELPERS INIT --}}
    @endpush
@endsection
