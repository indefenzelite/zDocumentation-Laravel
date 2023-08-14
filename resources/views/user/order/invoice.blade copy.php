@extends('layouts.empty')

@section('meta_data')
    @php
		$meta_title = 'Invoice | '.getSetting('app_name');		
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
<style>
    @media print {
        .printButton {
            display: none;
        }
    }
</style>

@section('content')
          <!-- Invoice Start -->
          <section class="bg-light mt-3">
            <div class="container">
                <div class="row mt-3 pt-4 mt-sm-0 mt-xs-0 justify-content-center">
                    <div class="col-lg-10">
                        <div class="card shadow rounded border-0">
                            <div class="card-body">
                                <div class="invoice-top pb-4 border-bottom">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="logo-invoice mb-2">{{ getSetting('app_name') }}<span class="text-primary">.</span></div>
                                            <a href="javascript:void(0)" class="text-primary h6"><i data-feather="link" class="fea icon-sm text-muted me-2"></i>www.{{ getSetting('app_name') }}.corp</a>
                                        </div><!--end col-->
    
                                        <div class="col-md-4 mt-4 mt-sm-0">
                                            <h5>Address :</h5>
                                            <dl class="row mb-0">
                                                <dt class="col-1 col-md-1 text-muted"><i data-feather="map-pin" class="fea icon-sm"></i></dt>
                                                <dd class="col-11 col-md-11 text-muted">
                                                    <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39206.002432144705!2d-95.4973981212445!3d29.709510002925988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c16de81f3ca5%3A0xf43e0b60ae539ac9!2sGerald+D.+Hines+Waterwall+Park!5e0!3m2!1sen!2sin!4v1566305861440!5m2!1sen!2sin" data-type="iframe" class="video-play-icon text-muted lightbox">
                                                        <p class="mb-0">{{ getSetting('frontend_footer_address') }}</p>
                                                        
                                                    </a>
                                                </dd>
    
                                                <dt class="col-1 text-muted"><i class="uil uil-envelope"></i></dt>
                                                <dd class="col-11 text-muted">
                                                    <a href="mailto:contact@example.com" class="text-muted">{{ getSetting('app_email') }}</a>
                                                </dd>
    
                                                <dt class="col-1 text-muted"><i data-feather="phone" class="fea icon-sm"></i></dt>
                                                <dd class="col-11 text-muted">
                                                    <a href="tel:+152534-468-854" class="text-muted">{{ getSetting('frontend_footer_phone') }}</a>
                                                </dd>
                                            </dl>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div>
                                <div class="invoice-middle py-4">
                                    <h5>Invoice Details :</h5>
                                    <div class="row mb-0">
                                        <div class="col-md-8 order-2 order-md-1">
                                            <dl class="row">
                                                <dt class="col-md-3 col-5 fw-normal">Invoice No. :</dt>
                                               
                                                <dd class="col-md-9 col-7 text-muted" style="margin-bottom:1px;">{{ ($order->id) }}</dd>
                                                
                                                <dt class="col-md-3 col-5 fw-normal">Name :</dt>
                                                <dd class="col-md-9 col-7 text-muted"style="margin-bottom:1px;">{{$order->user->first_name ?? ''}} {{$order->user->last_name ?? ''}}</dd>
                                                
                                                <dt class="col-md-3 col-5 fw-normal">Address :</dt>
                                                <dd class="col-md-9 col-7 text-muted"style="margin-bottom:1px;">
                                                    <p class="mb-0">{{$order->user->address ?? ''}}</p>
                                                </dd>
                                                
                                                <dt class="col-md-3 col-5 fw-normal">Phone :</dt>
                                                <dd class="col-md-9 col-7 text-muted"style="margin-bottom:1px;">{{$order->user->phone ?? ''}}</dd>
                                            </dl>
                                        </div>
    
                                        <div class="col-md-4 order-md-2 order-1 mt-2 mt-sm-0">
                                            <dl class="row mb-0">
                                                <dt class="col-md-4 col-5 fw-normal">Date :</dt>
                                                <dd class="col-md-8 col-7 text-muted">{{ ($order->date) }}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="invoice-table pb-4">
                                    <div class="table-responsive bg-white shadow rounded">
                                        <table class="table mb-0 table-center invoice-tb">
                                            @php
                                                $amount = 0;
                                                $subtotal = 0;
                                                $total = 0;
                                            @endphp
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col" class="border-bottom text-start">{{ __('No.')}}</th>
                                                    <th scope="col" class="border-bottom text-start">{{ __('Item')}}</th>
                                                    <th scope="col" class="border-bottom">{{ __('Qty')}}</th>
                                                    <th scope="col" class="border-bottom">{{ __('Rate')}}</th>
                                                    <th scope="col" class="border-bottom">{{ __('Total')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($order->items))
                                                    @foreach ($order->items as $item)
                                                        @php
                                                            $amount = $item->price * $item->qty;
                                                            $subtotal += $amount;
                                                            $total = $subtotal+$subtotal*$order->tax/100;
                                                        @endphp
                                                    <tr>
                                                        <th scope="row" class="text-start">{{ $loop->iteration }}</th>
                                                        <td class="text-start">{{ $item->item_type }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                        <td>{{ format_price($item->price) }}</td>
                                                        <td>{{ format_price($amount) }}</td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ms-auto">
                                            <ul class="list-unstyled h6 fw-normal mt-4 mb-0 ms-md-5 ms-lg-4">
                                                <li class="text-muted d-flex justify-content-between">Subtotal :<span> {{ format_price($subtotal) }}</span></li>
                                                <li class="text-muted d-flex justify-content-between">Taxes :<span> {{ $order->tax }}%</span></li>
                                                <li class="d-flex justify-content-between">Total :<span>{{ format_price($total) }}</span> </li>
                                            </ul>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div>
    
                                <div class="invoice-footer border-top pt-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="text-sm-start text-muted text-center printButton">
                                                <a href="javascript:void(0)" onclick="window.print()" title="Download PDF" class="btn btn-info pull-right" type="button">Print</a>
                                                {{-- <h6 class="mb-0">Customer Services : <a href="tel:+152534-468-854" class="text-warning">(+12) 1546-456-856</a></h6> --}}
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="text-sm-end text-muted text-center printButton">
                                                <h6 class="mb-0"><a href="{{ url('page/terms') }}" target="_blank" class="text-primary">Terms & Conditions</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- Invoice End -->


    
@endsection