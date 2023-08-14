@extends('layouts.user')

@section('meta_data')
    @php
		$meta_title = 'Wallet | '.getSetting('app_name');		
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
                                    <div>
                                        <h5 class="title mb-0">Wallet Logs</h5>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-sm wallet-recharge" id="addMoneyToWalley">Recharge</a>
                                </div>
    
                                @forelse ($walletLogs as $walletLog)
                                <div class="border-bottom  p-3">
                                    <div class="d-flex ms-2">
                                        <i class="uil uil-wallet text-primary h5 align-middle me-2 mb-0"></i>
                                        <div class="ms-3">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="text-dark mb-0">{{ ($walletLog->getPrefix()) }}
                                                    
                                                        <small>
                                                            At {{ $walletLog->formatted_created_at }}   
                                                        </small>
                                                    </h6>

                                                </div>
                                                <div style="position: absolute;right: 45px;">
                                                    <span class="text-{{ $walletLog->status_parsed->color}}">{{ $walletLog->status_parsed->label}}
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="text-muted d-block">
                                                {{ $walletLog->remark }}
                                            </span>
                                            <strong class="text-muted d-block fw-700"> {{ format_price($walletLog->amount) }} </strong>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                   @include('user.include.empty-record',['title' => 'No Records','width'=>15])
                                @endforelse    
                            </div>
                        </div> 
                        <div class ="mt-4 d-flex justify-content-end">
                            {{ $walletLogs->links()  }}
                        </div>  
                    </div>
                 </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Profile End -->
    @include('user.modal.add-wallet')



@endsection

@push('script')
<script>
    $(document).ready(function(){
        $('#addMoneyToWalley').on('click',function(){
            $('#add-wallet-modal').modal('show');
        });
    });
</script>
   
@endpush