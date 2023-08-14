
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{asset('site/assets/js/awesomplete.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{asset('site/assets/js/uikit.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('backend/plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>  

    {{-- Font Awesome CDN --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>

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
     @if(session('error'))
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
          $(document).on('click','.delete-item',function(e){
               e.preventDefault();
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
                              action: function(){
                                   window.location.href = url;
                              }
                         },
                              close: function () {
                         }
                    }
               });
          });
         
          $('.uil-times').hide();
            let mobnav = 0;
            $('.toggleBtn').on('click',function(){
                $('.toggle-area').toggle(200);
            });
            $('#toggle-submenu').on('click',function(){
                $('#show-submenu').toggle(200);
          });
     </script>
     
     @if(getSetting('custom_header_script') != 0)
          <script src="{!! getSetting('custom_header_script') !!}"></script>
     @endif
     @if(getSetting('custom_footer_script') != 0)
          <script src="{!! getSetting('custom_footer_script') !!}"></script>
     @endif