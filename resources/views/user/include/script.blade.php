<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('user/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('user/assets/libs/feather-icons/feather.min.js') }}"></script>
<!-- Main Js -->
<script src="{{ asset('user/assets/js/plugins.init.js') }}"></script>
<script src="{{ asset('user/assets/js/app.js') }}"></script>
<script src="{{ asset('user/assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

{{-- JQUERY CONFIRM CDN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

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


<script>
    $(document).on('click', '.delete-item', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var msg = $(this).data('msg') ?? "You won't be able to revert back!";
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
                        window.location.href = url;
                    }
                },
                close: function() {}
            }
        });
    });

    $('.uil-times').hide();
    var mobnav = 0;
    $('.toggleBtn').on('click', function() {
        $('.toggle-area').toggle(200);
    });
    $('#toggle-submenu').on('click', function() {
        $('#show-submenu').toggle(200);
    });
//     $(document).ready(function() {
//         $('input[type="text"]').each(function() {
//             $(this).on('blur', function() {
//                 validateAtLeastOneCharacter($(this));
//             });
//         });

//         function validateAtLeastOneCharacter(inputElement) {
//             var inputValue = inputElement.val();

//             if (inputValue.length === 0) {
//                 return; // No need to validate if input is empty
//             }

//             if (!/^[a-zA-Z]/.test(inputValue)) {
//                 $.toast({
//                     heading: "Oops",
//                     text: "First character must be an alphabet character.",
//                     showHideTransition: 'slide',
//                     icon: "error",
//                     loaderBg: '#f96868',
//                     position: 'top-right'
//                 });
//                 inputElement.val('');
//             } else if (!/[a-zA-Z]/.test(inputValue)) {
//                 $.toast({
//                     heading: "Oops",
//                     text: "Input must contain at least one character.",
//                     showHideTransition: 'slide',
//                     icon: "error",
//                     loaderBg: '#f96868',
//                     position: 'top-right'
//                 });
//                 inputElement.val('');
//             }
//         }
//     });
</script>
