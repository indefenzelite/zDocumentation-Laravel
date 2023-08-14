@extends('layouts.user')

@section('meta_data')
    @php
		$meta_title = 'Payout Request | '.getSetting('app_name');		
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
                                <h5 class="title mb-0">Payout Requests</h5>
                                @if(!$is_pending_request)
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" id="payout-btn">Request Payout</a>
                                @else
                                <span class="alert alert-secondary">
                                   One Request is in Progress... 
                                </span>
                                @endif
                            </div>
                            @forelse ($payouts as $payout)
                                <div class="border-bottom  p-3">
                                    <a href="javascript:void(0)">
                                        <div class="ms-2">
                                            <i class="uil uil-transaction h5 align-middle" style="position: absolute"></i>
                                            <div class="ms-4">
                                               <div class="w-100 d-flex justify-content-between">
                                                   <div>
                                                       <h6 class="text-dark mb-0">
                                                            {{ $payout->getPrefix() }}
                                                            @if($payout->remark != null)
                                                                <i title="{{$payout->remark}}" class="uil uil-info-circle"></i>
                                                            @endif    
                                                        </h6>
                                                   </div>

                                                   <div>
                                                        <span class="text-{{ $payout->statusParsed->color }}">
                                                            {{ $payout->statusParsed->label }}
                                                        </span>   
                                                    </div>
                                               </div>
                                                <small class="text-muted d-block"><i class="uil uil-clock"></i> {{ $payout->created_at }} </small>
                                                <small class="text-success d-block">{{ format_price($payout->amount) }} 
                                                    @if($payout->bank_details != null)
                                                        <span class="text-muted">
                                                            <i class="uil uil-arrow-up-right"></i>
                                                            A/c ending {{ substr($payout->bank_details['account_no'],-4) }} 
                                                        </span>
                                                    @endif
                                                    
                                                    <br>
                                                    @if($payout->txn_no != null)
                                                        <span class="text-muted">Txn {{$payout->txn_no}} At {{$payout->approved_at}} By {{$payout->approver->full_name}}</span>
                                                    @endif 
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @empty
                                    @include('user.include.empty-record',['title' => 'No Records','width'=>15])
                                @endforelse 
                        </div>
                    </div>
                    <div class ="mt-4 d-flex justify-content-end">
                        {!! $payouts->links()  !!}
                    </div>
                   </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Profile End -->
 @include('user.modal.create-payout')
 @include('user.modal.add-details')
@endsection



@push('script')
   <script>
    $('#payout-btn').on('click',function(){
        $('#add-payout-modal').modal('show');
    });
    $('#addBankBtn').on('click',function(){
        $('#addPayoutDetailReqModal').modal('show');
    });
    $('#stateEdit').on('change', function() {
        getEditCities($(this).val());
    });
    $('#ajaxform').on('submit', function(e){
        e.preventDefault();
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            $.ajax({
                contentType: false,
                processData: false,
                type: method,
                url: route,
                dataType : "json",
                data: data,
                headers: {
                    "Accept": "application/json"
                },
                //if received a response from the server
                success: function(data, textStatus, jqXHR) {
                    $.toast({
                        heading: data.message,
                        text: data.title,
                        showHideTransition: 'slide',
                        icon: "success",
                        loaderBg: '#f96868',
                        position: 'top-right'
                    }); 
                    
                    $('#addPayoutDetailReqModal').modal('hide');
                },

                //If there was no response from the server
                error: function( data, textStatus, jqXHR){
                    let err = eval("(" + data.responseText + ")");
                    if(data.status == 500 || data.status == 400)
                    $.toast({
                            heading: "Oops",
                            text: err.error,
                            showHideTransition: 'slide',
                            icon: "error",
                            loaderBg: '#f96868',
                            position: 'top-right'
                        }); 
                    else
                    $.each(err.errors, function(index, value) {
                        $.toast({
                            heading: "Oops",
                            text: value,
                            showHideTransition: 'slide',
                            icon: "error",
                            loaderBg: '#f96868',
                            position: 'top-right'
                        }); 
                    }); 
                },
            });
    });
   </script>
@endpush