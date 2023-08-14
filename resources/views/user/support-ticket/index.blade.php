@extends('layouts.user')

@section('meta_data')
    @php
		$meta_title = 'Support Ticket | '.getSetting('app_name');		
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('app_email');		
		$meta_img = ' ';		
		$customer = 1;		
	@endphp
@endsection

@section('content')
    <!-- Profile Start -->
    <section class="section mt-60">
        <div class="container mt-lg-3">
            <div class="row">
                @include('user.include.sidebar')
                <div class="col-lg-8 col-12">
                   <div class="row">
                    <div class="col-12">
                        <div class="component-wrapper rounded shadow bg-white">
                            <div class="p-3 border-bottom d-flex justify-content-between">
                                <h5 class="title mb-0">Support Ticket</h5>
                                <a href="javascript:void(0);"  class="btn btn-primary btn-sm" id="ticket-btn">Raise Ticket</a>
                            </div>
                            @forelse ($supportTickets as $supportTicket)
                                <div class="border-bottom  p-3">
                                    <a href="{{route('user.support-ticket.show',$supportTicket->id)}}">
                                        <div class="d-flex ms-2">
                                            <i class="uil uil-envelope h5 align-middle me-2 mb-0"></i>
                                            <div class="ms-3">
                                               <div class="d-flex justify-content-between">
                                                   <div>
                                                       <h6 class="text-dark mb-0">{{ $supportTicket->subject }}</h6>
                                                   </div>
                                                   <div class="">
                                                     <span class="text-info">{{ $supportTicket->priority }}</span>
                                                   </div>
                                                   <div style="position: absolute;right: 45px;">
                                                    {{-- <span class="text-{{ $supportTicket->status_parsed->color}} m-1">{{ $supportTicket->status_parsed->label}}</span> --}}

                                                    </div>   
                                               </div>
                                                <small class="text-muted d-block">Created At {{ $supportTicket->created_at }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                @include('user.include.empty-record',['title' => 'No Records','width'=>15])
                            @endforelse
                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-end">
                        <div class="pagination">
                            {{ $supportTickets->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                   </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Profile End -->
    @include('user.modal.raise-ticket')  
@endsection



@push('script')
<script>
    $('#ticket-btn').on('click',function(){
        $('#raise-ticket-modal').modal('show');
    });
   </script>
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
   integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
   integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
   integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
@endpush
