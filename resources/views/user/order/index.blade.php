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
                                <div>
                                    <h5 class="title mb-0">Orders</h5>
                                </div>
                                <a href="#" class="btn btn-primary btn-sm Add Order" id="addCreateOrder">Add Order</a>
                            </div>
                            @forelse ($orders as $order)
                                <div class="border-bottom  p-3">
                                    <a href="{{ route('user.order.invoice',$order->id) }}">
                                        <div class="d-flex ms-2">
                                            <i class="uil uil-shopping-cart-alt me-2 mb-0"></i>
                                            <div class="ms-3">
                                               <div class="d-flex justify-content-between">
                                                   <div>
                                                       <h6 class="text-dark mb-0">{{ $order->getPrefix() }}</h6>
                                                   </div>
                                                   <div style="position: absolute;right: 45px;">
                                                    <span class="text-{{ $order->status_parsed->color}} m-1">{{ $order->status_parsed->label}}</span>
                                                   </div>   
                                               </div>
                                                <small class="text-muted d-block">Created At {{ $order->formatted_created_at }} </small>
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
                            {{ $orders->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                   </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- Profile End -->
    @include('user.modal.create-order')
@endsection



@push('script')
<script>
    $(document).ready(function(){
        $('#addCreateOrder').on('click',function(){
            $('#add-order-modal').modal('show');
        });
    });
    function getval(item)
    {
        if(item.value){
            $.ajax({
                url: '{{ route('user.order.getItem') }}',
                type: 'GET',
                data: {
                    itemId: item.value
					},
                dataType: 'json',
                success: function(data) {
                    console.log(data.mrp_price);

                    $('#total').val(data.sell_price);
                }
            });
        }else{
            $('#total').val(0);

        }
            
 
    }
</script>
  
@endpush