    {{-- Ajax CSRF initialization --}}
    <script type="text/javascript">
        var ajaxMessage = ".ajax-message";
        var ajaxContainer = "#ajax-container";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('admin/all.js') }}"></script>

    <script src="{{ asset('admin/dist/js/theme.js') }}"></script>
    <!-- Stack array for including inline js or scripts -->

    <script src="{{ asset('admin/plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatables.js') }}"></script>
    <script src="{{ asset('admin/plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>
    <script src="{{ asset('admin/plugins/nprogress/nprogress.js') }}"></script>

    <!--get role wise permissiom ajax script-->
    <script src="{{ asset('admin/plugins/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('admin/js/ajaxForm.js') }}"></script>
    <script src="{{ asset('admin/js/index-page.js') }}"></script>

    {{-- Bootstrap CDN --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script> --}}

    {{-- JQUERY CONFIRM CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    {{-- Font Awesome CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>

    <script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>


    <!--get role wise permissiom ajax script-->
    <script src="{{ asset('admin/js/get-role.js') }}"></script>


    <script>
        var paceOptions = {
            ajax: true
        }
    </script>

    <script src="{{ asset('admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/alerts.js')}}"></script> --}}

    <script src="{{ asset('admin/js/form-components.js') }}"></script>

    <script src="{{ asset('admin/js/form-advanced.js') }}"></script>
    {{-- start ------------ important js code must include in all backend pages  --}}


    {{-- Date Range Filter JS Code Start --}}

    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

    @stack('script')

    @if (getSetting('voice_input') == 1)
        <script src="{{ asset('admin/js/speechRecognition.js') }}"></script>
    @endif
    <script type="text/javascript">
        var ajaxMessage = '.ajax-message';
        $('select.select2').select2();


        $(function() {
            let dateInterval = getQueryParameter('date_filter');
            let start = moment().startOf('isoWeek');
            let end = moment().endOf('isoWeek');
            if (dateInterval) {
                dateInterval = dateInterval.split(' - ');
                start = dateInterval[0];
                end = dateInterval[1];
            }
            $('#date_filter').daterangepicker({
                "showDropdowns": true,
                "showWeekNumbers": true,
                "alwaysShowCalendars": true,
                startDate: start,
                endDate: end,
                locale: {
                    format: 'YYYY-MM-DD',
                    firstDay: 1,
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
                        .endOf('year')
                    ],
                    'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
                }
            });
        });

        function getQueryParameter(name) {
            const url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        function copyTextToClipboard(text) {
            if (!navigator.clipboard) {
                fallbackCopyTextToClipboard(text);
                return;
            }
            navigator.clipboard.writeText(text).then(function() {
                console.log('Async: Copying to clipboard was successful!');
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }
    </script>
    {{-- Date Range Filter JS Code End --}}

    <script>
        function menuSearch() {
            var filter, item;
            filter = $("#menu-search").val().trim().toLowerCase();
            items = $("#main-menu-navigation").find("a");
            items = items.filter(function(i, item) {
                if ($(item).html().trim().toLowerCase().indexOf(filter) > -1 && $(item).attr('href') !== '#') {
                    return item;
                }
            });
            if (filter !== '') {
                $("#main-menu-navigation").addClass('d-none');
                $("#search-menu-navigation").html('')
                if (items.length > 0) {
                    for (i = 0; i < items.length; i++) {
                        const text = $(items)[i].innerText;
                        const link = $(items[i]).attr('href');
                        $("#search-menu-navigation").append(
                            `<div class="nav-item"><a href="${link}" class="a-item"><i class="ik ik-more-horizontal"></i><span>${text}</span></a></li`
                            );
                    }
                } else {
                    $("#search-menu-navigation").html(
                        `<div class="nav-item"><span	class="text-center text-muted d-block">{{ __('Nothing Found') }}</span></div>`
                        );
                }
            } else {
                $("#main-menu-navigation").removeClass('d-none');
                $("#search-menu-navigation").html('')
            }
        }

        function refreshCheckboxes() {
            new Switchery(document.querySelector('.js-single'), {
                color: '#4099ff',
                jackColor: '#fff'
            });
            var elem = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            elem.forEach(function(html) {
                var switchery = new Switchery(html, {
                    color: '#4099ff',
                    jackColor: '#fff'
                });
            });
        }
        $('.sidebar-content').animate({
            scrollTop: $('.active').offset().top - 70
        }, 1000);
    </script>

    {{-- <script src="{{ asset('admin/js/chat.js') }}"></script> --}}

    {{-- end ------------ important js code must include in all backend pages  --}}

    @if (session('success'))
        <script>
            $.toast({
                heading: 'SUCCESS',
                text: "{{ session('success') }}",
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-right'
            });
        </script>
    @endif


    @if (session('error'))
        <script>
            $.toast({
                heading: 'ERROR',
                text: "{{ session('error') }}",
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'top-right'
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            $.toast({
                heading: 'WARNING',
                text: "{{ session('warning') }}",
                showHideTransition: 'slide',
                icon: 'warning',
                loaderBg: '#f2a654',
                position: 'top-right'
            });
        </script>
    @endif
    <script>
        // $(document).ready(function() {
        //     $('input[type="text"]').each(function() {
        //         $(this).on('blur', function() {
        //             validateAtLeastOneCharacter($(this));
        //         });
        //     });

        //     function validateAtLeastOneCharacter(inputElement) {
        //         var inputValue = inputElement.val();

        //         if (inputValue.length === 0) {
        //             return; // No need to validate if input is empty
        //         }

        //         if (!/^[a-zA-Z]/.test(inputValue)) {
        //             $.toast({
        //                 heading: "Oops",
        //                 text: "First character must be an alphabet character.",
        //                 showHideTransition: 'slide',
        //                 icon: "error",
        //                 loaderBg: '#f96868',
        //                 position: 'top-right'
        //             });
        //             inputElement.val('');
        //         } else if (!/[a-zA-Z]/.test(inputValue)) {
        //             $.toast({
        //                 heading: "Oops",
        //                 text: "Input must contain at least one character.",
        //                 showHideTransition: 'slide',
        //                 icon: "error",
        //                 loaderBg: '#f96868',
        //                 position: 'top-right'
        //             });
        //             inputElement.val('');
        //         }
        //     }
        // });
        $(document).on('click', '.delete-item', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let is_ajax = $(this).data('is_ajax');
            let callback = $(this).data('callback');
            let method = $(this).data('method');
            let msg = $(this).data('msg') ?? "You won't be able to revert back!";
            $.confirm({
                draggable: true,
                title: 'Are You Sure!',
                content: msg,
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Delete',
                        btnClass: 'btn-red',
                        action: function() {
                            if (is_ajax == 1) {
                                getData(method, url, "json", null, callback = null, event = null,
                                    toast = 1);
                            } else {
                                window.location.href = url;
                            }
                        }
                    },
                    close: function() {}
                }
            });
        });
        $(document).on('click', '.confirm', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var msg = $(this).data('msg') ?? "You won't be able to revert back!";
            $.confirm({
                draggable: true,
                title: 'Are You Sure!',
                content: msg,
                type: 'blue',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Confirm',
                        btnClass: 'btn-blue',
                        action: function() {
                            window.location.href = url;
                        }
                    },
                    close: function() {}
                }
            });
        });
        $(document).on('click', '.confirm-form-btn', function(e) {
            e.preventDefault();
            let $this = $(this);
            let msg = $(this).data('msg') ?? "You won't be able to revert back!";
            $.confirm({
                draggable: true,
                title: 'Are You Sure!',
                content: msg,
                type: 'blue',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Confirm',
                        btnClass: 'btn-blue',
                        action: function() {
                            $this.closest('form').submit();
                        }
                    },
                    close: function() {}
                }
            });
        });

        function updateURL(key, val) {
            var url = window.location.href;
            var reExp = new RegExp("[\?|\&]" + key + "=[0-9a-zA-Z\_\+\-\|\.\,\;]*");

            if (reExp.test(url)) {
                // update
                var reExp = new RegExp("[\?&]" + key + "=([^&#]*)");
                var delimiter = reExp.exec(url)[0].charAt(0);
                url = url.replace(reExp, delimiter + key + "=" + val);
            } else {
                // add
                var newParam = key + "=" + val;
                if (!url.indexOf('?')) {
                    url += '?';
                }

                if (url.indexOf('#') > -1) {
                    var urlparts = url.split('#');
                    url = urlparts[0] + "&" + newParam + (urlparts[1] ? "#" + urlparts[1] : '');
                } else {
                    url += "?" + newParam;
                }
            }
            window.history.pushState(null, document.title, url);
        }
        $(document).on('click', '.delete-media', function(e) {
            e.preventDefault();
            let parent = $(this).parent('.media-div');
            let url = $(this).attr('href');
            let msg = $(this).data('msg') ?? "You won't be able to revert back!";
            $.confirm({
                draggable: true,
                title: 'Are You Sure!',
                content: msg,
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Delete',
                        btnClass: 'btn-red',
                        action: function() {
                            getData("get", url, "json", null, callback = null, event = null, toast = 1);
                            $(parent).remove();
                        }
                    },
                    close: function() {}
                }
            });
        });

        function getUsers() {
            $(".getUsersList").select2({
                placeholder: $(this).data('placeholder'),
                language: {
                        searching: function () {
                            return "Search For Users"; // You can provide your own message here
                        }
                    },
                ajax: {
                    url: "{{ route('admin.users.get-users') }}",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: $.map(response, function(item, index) {
                                return {
                                    text: "#UID" + item.id + " | " + item.name + " | " + item.email +
                                        " | " + item.phone,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }

        function getItems() {
            $(".getItemsList").select2({
                language: {
                        searching: function () {
                            return "Search For Items"; // You can provide your own message here
                        }
                    },
                ajax: {
                    url: "{{ route('admin.items.get-items') }}",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: $.map(response, function(item, index) {
                                return {
                                    text: "#IID" + item.id + " | " + item.name + " | " + "₹" + item
                                        .sell_price + " | " + item.status,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }

        $(document).on('click', '.off-canvas', function(e) {
            e.stopPropagation();
            var type = $(this).data('type');
            $('.side-slide').animate({
                right: type == 'close' ? "-100%" : "0px"
            }, 200);
        });
        $(document).on('.close.off-canvas', function() {
            var type = $(this).data('type');
            $('.side-slide').animate({
                right: type == 'close' ? "-100%" : "0px"
            }, 200);
        });
    </script>

    {!! getSetting('plugin_script') !!}
