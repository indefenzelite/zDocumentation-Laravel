@extends('layouts.main')
@section('title', 'Compose a new mail')
<!-- push external head elements to head -->
@push('head')
    <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
@endpush
@section('content')

    @php
        $breadcrumb_arr = [
            // ['name'=>'Constant Management', 'url'=> "javascript:void(0);", 'class' => ''],
            ['name' => 'Email Compose', 'url' => 'javascript:void(0);', 'class' => 'active'],
        ];
    @endphp

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-mail bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Compose a new mail') }}</h5>
                            <span>{{ __('Compose a new mail and send to any user') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('admin.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            {{-- @include('include.message') --}}
            <!-- end message area-->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>{{ __('Compose a new mail') }}</h3>
                        {{-- <a href="#" class="btn btn-primary"> Add</a> --}}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.compose-emails.send') }}" id="emailComposer" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label for="">Want to select data via :</label>
                                        <label for="manual_input" class="mx-3"> <input type="radio" name="input_type"
                                                value="1" id="manual_input"> Manual Input</label>
                                        <label for="group_input" class="mx-3"> <input type="radio" name="input_type"
                                                value="2" id="group_input"> Group Input</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 group_input d-none">
                                    <div class="form-group">
                                        <label for="role_selection">Send To</label>
                                        <select name="role_selection" id="role_selection" class="form-control">
                                            <option value="">--Select Role--</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 manual_input d-none">
                                    <div class="form-group">
                                        <label for="user_selection">Send To</label>
                                        <select name="user_selection" id="user_selection" class="form-control">
                                            <option value="">--Select User--</option>
                                            <option value="new">New Email ID</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->email }}">{{ $user->name }}</option>
                                            @endforeach
                                            {{-- @foreach (AgentList() as $user)
                                                <option value="{{ $user->email }}">{{ $user->name }}</option>
                                            @endforeach
                                            @foreach (ClientList() as $user)
                                            <option value="{{ $user->email }}">{{ $user->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6" id="email pattern="[a-zA-Z]+.*"
                                    title="Please enter first letter alphabet and at least one alphabet character is required."
                                    <div class="form-group">
                                    <label for="email">To</label>
                                    <textarea type="email" pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control"
                                        name="email" id="email" placeholder="Email"></textarea>
                                </div>
                            </div> pattern="[a-zA-Z]+.*"
                            title="Please enter first letter alphabet and at least one alphabet character is required."

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="cc">CC</label>
                                    <input type="email" pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required."
                                        class="form-con pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required.""
                                        placeholder="CC Email">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bcc">BCC</label>
                                    <input type="email pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required.""
                                        title="Please enter first letter alphabet and at least one alphabet character is required."
                                        class="form-control" name="bcc" id="bcc" placeholder="BCC Email">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" pattern="[a-zA-Z]+.*"
                                        title="Please enter first letter alphabet and at least one alphabet character is required."
                                        class="form-control" name="subject" id="subject" placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="attach">Template</label>
                                    <select name="template_id" id="template_id" class="form-control">
                                        <option value="" readonly>Select Template</option>
                                        @foreach (App\Models\MailSmsTemplate::whereType(1)->get() as $template)
                                            <option value="{{ $template->id }}">
                                                {{ ucwords(str_replace('-', ' ', $template->code)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-9 col-sm-9">
                                <div class="form-group">
                                    <label for="attach">Attachments</label>
                                    <input type="file" name="attachments[]" multiple id="">
                                    {{-- <select name="attach[]" id="attach" class="form-control" multiple> 
                                            @foreach (UserList() as $user)
                                                <option value="{{ $user->email }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select> --}}
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-sm-3">
                                <div class="form-group mt-4">
                                    <button type="button" class="btn btn-primary" id="prepareMessage">Prepare
                                        Message</button>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <input type="hidden" class="messageText" name="message">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <div id="content-holder">
                                            <div id="toolbar-container"></div>
                                            <div id="txt_area">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control html-editor" rows="6" name="message" id="message" placeholder="Message" style="resize: none"></textarea>
                                    </div> --}}
                            </div>
                            <div class="col-lg-12">
                                <input type="hidden" class="bodyText" name="body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="body">Footer</label>
                                        <div id="content-holder">
                                            <div id="toolbar-container-footer"></div>
                                            <div id="txt_area_footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                        <label for="body">Footer</label>
                                        <textarea class="form-control" required rows="6" name="body" id="bodytextarea" placeholder="Body" style="resize: none"></textarea>
                                    </div> --}}
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
    </div>




@endsection
<!-- push external js -->
@push('script')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    {{-- START CKEDITOR INIT --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/decoupled-document/ckeditor.js"></script>
    <script>
        let editor1, editor2;

        $(window).on('load', function() {
            $('#txt_area').addClass('ck-editor');
            DecoupledEditor
                .create(document.querySelector('#txt_area'), {
                    ckfinder: {
                        uploadUrl: "{{ route('admin.media.ckeditor.upload') . '?_token=' . csrf_token() }}",
                    }
                })
                .then(newEditor => {
                    editor1 = newEditor;
                    const toolbarContainer = document.querySelector('#toolbar-container');

                    toolbarContainer.appendChild(editor1.ui.view.toolbar.element);
                })
                .catch(error => {
                    console.error(error);
                });

            $('#txt_area_footer').addClass('ck-editor');
            DecoupledEditor
                .create(document.querySelector('#txt_area_footer'), {
                    ckfinder: {
                        uploadUrl: "{{ route('admin.media.ckeditor.upload') . '?_token=' . csrf_token() }}",
                    }
                })
                .then(newEditor => {
                    editor2 = newEditor;
                    const toolbarContainer = document.querySelector('#toolbar-container-footer');

                    toolbarContainer.appendChild(editor2.ui.view.toolbar.element);
                })
                .catch(error => {
                    console.error(error);
                })
        });
        const editorData = document.querySelector('#txt_area').innerHTML;
        document.querySelector('.messageText').value = editorData;
    </script>
    {{-- END CKEDITOR INIT --}}
    <script>
        $('#emailComposer').on('submit', function() {
            const editorData = document.querySelector('#txt_area').innerHTML;
            document.querySelector('.messageText').value = editorData;
            const bodyData = document.querySelector('#txt_area_footer').innerHTML;
            document.querySelector('.bodyText').value = editorData;
        });
        $('input[name="input_type"]').change(function() {
            $('#email').val('');
            if ($(this).val() == 1) {
                $('.manual_input').removeClass('d-none');
                $('.group_input').addClass('d-none');
            } else if ($(this).val() == 2) {
                $('.group_input').removeClass('d-none');
                $('.manual_input').addClass('d-none');
            }
        });

        $(document).ready(function() {
            $('#prepareMessage').on('click', function() {
                var user_emails = $('#attach').val();
                var template_id = $('#template_id').val();
                var url = "";
                if (user_emails) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            user_emails: user_emails
                        },
                        dataType: "html",
                        success: function(resultData) {
                            console.log(resultData);
                            editor1.setData(resultData.message);
                            // CKEDITOR.instances['bodytextarea'].setData(resultData.footerhtml);
                            // CKEDITOR.instances['message'].setData(resultData.msghtml);
                        }
                    });
                }
                if (template_id) {
                    url = "{{ route('admin.compose-emails.get-template') }}";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            template_id: template_id
                        },
                        dataType: "json",
                        success: function(resultData) {
                            console.log(resultData);
                            $('#subject').val(resultData.template.subject);
                            editor2.setData(resultData.body);
                        },
                        error: function(error) {
                            $.toast({
                                heading: 'ERROR',
                                text: error.error,
                                showHideTransition: 'slide',
                                icon: 'error',
                                loaderBg: '#f2a654',
                                position: 'top-right'
                            });
                        }
                    });
                }

            });

            $('#email-container').hide();
            $(document).on('change', '#role_selection', function(e) {
                var role = $(this).val();
                $.ajax({
                    type: "get",
                    url: "",
                    data: {
                        role: role
                    },
                    success: function(data) {
                        $('#email').val('');
                        $('#email').val($.trim(data));
                        $('#email-container').fadeIn(250);
                    }
                });

            });
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
@endpush
