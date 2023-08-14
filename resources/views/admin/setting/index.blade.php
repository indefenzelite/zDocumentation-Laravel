@extends('layouts.main') 
@section('title', $label)
@section('content')
@push('head')
	<link rel="stylesheet" href="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.css') }}">
@endpush
    @php
        $breadcrumb_arr = [
            ['name'=>$label, 'url'=> "javascript:void(0);", 'class' => 'active']
        ]
    @endphp
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
					<i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __($label)}}</h5>
                            <span>{{ __('This setting will be automatically Save & Updated in your website.')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
					<div>
						@include('admin.include.breadcrumb')
					</div>
                </div>
				@include('admin.modal.sitemodal',['title'=>"How to use",'content'=>"You need to create a unique code and call the unique code with paragraph content helper."])
            </div>
        </div>  

		<div class="row">
			<div class="col-md-10 mx-auto">
				<div class="card">
					<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Control Details')}}</a>
						</li>
						<li class="nav-item">
							<a data-active="security" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "security") active @endif"  id="pills-security-tab" data-toggle="pill" href="#security" role="tab" aria-controls="pills-security" aria-selected="true">{{ __('Custom Style')}}</a>
						</li>
						<li class="nav-item">
							<a data-active="customscript" class="nav-link active-swicher @if(request()->has('active') && request()->get('active') == "customscript") active @endif"  id="pills-customscript-tab" data-toggle="pill" href="#customscript" role="tab" aria-controls="pills-customscript" aria-selected="true">{{ __('Custom Script')}}</a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
							<div class="card-body">
								<div class="row gutters-10">
									<div class="col-lg-6">
										<div class="card shadow-none bg-light">
											<div class="card-header">
												<h6 class="mb-0">{{ ('About Website') }}</h6>
											</div>
											<div class="card-body">
												<form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="group_name" value="{{ 'website_footer_about' }}">
													<div class="form-group">
														<label>{{ ('About Content') }}</label>
														<a href="javascript:void(0);" title="@lang('admin/tooltip.general_setting_about_content')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
														<textarea class="form-control" name="frontend_footer_description" rows="9" placeholder="Enter Short Description Here..." data-min-height="150">{{ trim(getSetting('frontend_footer_description')) }}</textarea>
													</div>
													<div class="form-group">
														<label>{{ ('Map Location') }}<span class="text-red">*</span></label>
														<a href="javascript:void(0);" title="@lang('admin/tooltip.general_setting_map_location')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
														<textarea required name="frontend_map_code" id="" class="form-control" cols="30" rows="3">{{ getSetting('frontend_map_code') }}</textarea>
													</div>
													<div class="form-group">
														<label>{{ ('Copyright') }}</label>
														<a href="javascript:void(0);" title="@lang('admin/tooltip.general_setting_copyright')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
														<textarea class="aiz-text-editor form-control" name="frontend_copyright_text" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">{{ getSetting('frontend_copyright_text') }}</textarea>
													</div>

													<div class="text-right">
														<x-button>
															Save & Update
														</x-button>
													</div>
												</form>
											</div>
										</div>
										
									</div>
									<div class="col-lg-6">
										<div class="card shadow-none bg-light">
											<div class="card-header">
												<h6 class="mb-0">{{ ('Bussiness Address') }}</h6>
											</div>
											<div class="card-body">
												<form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="group_name" value="{{ 'website_footer_contact' }}">
													<div class="form-group">
														<label>{{ ('Primary Address') }}<span class="text-red">*</span></label>
														<a href="javascript:void(0);" title="@lang('admin/tooltip.general_setting_primary_address')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
														<textarea required name="frontend_footer_address" id="" class="form-control" cols="30" rows="3">{{ getSetting('frontend_footer_address') }}</textarea>
													</div>
													<div class="form-group">
														<label>{{ ('Secondary Address') }}<span class="text-red">*</span></label>
														<a href="javascript:void(0);" title="@lang('admin/tooltip.general_setting_secondary_address')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
														<textarea required name="frontend_footer_address_secondary" id="" class="form-control" cols="30" rows="3">{{ getSetting('frontend_footer_address_secondary') }}</textarea>
													</div>
													<div class="form-group">
														<label>{{ ('Primary Number') }}<span class="text-red">*</span></label>
														<a href="javascript:void(0);" title="@lang('admin/tooltip.general_setting_primary_number')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
														<input type="text" class="form-control" placeholder="{{ ('Phone') }}" name="frontend_footer_phone" value="{{ getSetting('frontend_footer_phone') }}"required>
													</div>
													<div class="form-group">
														<label>{{ ('Secondary Number') }}<span class="text-red">*</span></label>
														<a href="javascript:void(0);" title="@lang('admin/tooltip.general_setting_secondary_number')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
														<input type="text" class="form-control" placeholder="{{ ('Phone') }}" name="frontend_footer_phone_secondary" value="{{ getSetting('frontend_footer_phone_secondary') }}"required>
													</div>
													<div class="form-group">
														<label>{{ ('Primary Email') }}<span class="text-red">*</span></label>
														<a href="javascript:void(0);" title="@lang('admin/tooltip.general_setting_primary_email')"><i class="ik ik-help-circle text-muted ml-1"></i></a>
														<input type="text" pattern="[a-zA-Z]+.*" title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." title="Please enter first letter alphabet and at least one alphabet character is required." class="form-control" placeholder="{{ ('Email') }}" name="frontend_footer_email" value="{{ getSetting('frontend_footer_email') }}"required>
													</div>
													<div class="text-right">
														<x-button>
															Save & Update
														</x-button>
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="group_name" value="{{ 'website_footer_bottom' }}">
										   <div class="card-body p-0">
												
												<div class="card shadow-none bg-light">
													<div class="card-header">
														<h6 class="mb-0">{{ ('Control Social Links') }}</h6>
													</div>
												  <div class="card-body">
													<div class="form-group">
														{{-- @dd(getSetting('facebook_link')); --}}
														<div class="input-group form-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="ik ik-facebook"></i></span>
															</div>
															<input type="url" class="form-control" placeholder="http://" name="facebook_link" value="{{ getSetting('facebook_link') }}">
														</div>
														<div class="input-group form-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="ik ik-twitter"></i></span>
															</div>
															<input type="url" class="form-control" placeholder="http://" name="twitter_link" value="{{ getSetting('twitter_link') }}">
														</div>
														<div class="input-group form-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="ik ik-instagram"></i></span>
															</div>
															<input type="url" class="form-control" placeholder="http://" name="instagram_link" value="{{ getSetting('instagram_link') }}">
														</div>
														<div class="input-group form-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="ik ik-youtube"></i></span>
															</div>
															<input type="url" class="form-control" placeholder="http://" name="youtube_link" value="{{ getSetting('youtube_link') }}">
														</div>
														<div class="input-group form-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="ik ik-linkedin"></i></span>
															</div>
															<input type="url" class="form-control" placeholder="http://" name="linkedin_link" value="{{ getSetting('linkedin_link') }}">
														</div>
													</div>
												  </div>
												</div>
												<div class="text-right">
													<x-button>
														Save & Update
													</x-button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade @if(request()->has('active') && request()->get('active') == "security") show active @endif" id="security" role="tabpanel" aria-labelledby="pills-security-tab">
							<div class="card-body">
								<form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data" class="ajaxForm">
									@csrf
									<input type="hidden" name="active" value="{{ 'security' }}">
									<input type="hidden" name="group_name" value="{{ 'appearance_custom_style' }}">
									<div class="form-group row">
										<label class="col-md-3 col-from-label">{{ ('Header custom style - before </head>') }}</label>
										<div class="col-md-8">
											<textarea name="custom_header_style" rows="4" class="form-control" placeholder="<style>&#10;...&#10;</style>">{{ getSetting('custom_header_style') }}</textarea>
											<small>{{ ('Write style with <style> tag') }}</small>
										</div>
									</div>
									
									<div class="text-right">
										<button type="submit" class="btn btn-primary">{{ ('Update') }}</button>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane fade @if(request()->has('active') && request()->get('active') == "customscript") show active @endif" id="customscript" role="tabpanel" aria-labelledby="pills-customscript-tab">
							<div class="card-body">
								<form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data" class="ajaxForm">
									@csrf
									<input type="hidden" name="active" value="{{ 'customscript' }}">
									<input type="hidden" name="group_name" value="{{ 'appearance_custom_script' }}">
									<div class="form-group row">
										<label class="col-md-3 col-from-label">{{ ('Header custom script - before </head>') }}</label>
										<div class="col-md-8">
											<textarea name="custom_header_script" rows="4" class="form-control" placeholder="<script>&#10;...&#10;</script>">{{ getSetting('custom_header_script') }}</textarea>
											<small>{{ ('Write script with <script> tag') }}</small>
										</div>
									</div>
									@csrf
									<div class="form-group row">
										<label class="col-md-3 col-from-label">{{ ('Footer custom script - before </body>') }}</label>
										<div class="col-md-8">
											<textarea name="custom_footer_script" rows="4" class="form-control" placeholder="<script>&#10;...&#10;</script>">{{ getSetting('custom_footer_script') }}</textarea>
											<small>{{ ('Write script with <script> tag') }}</small>
										</div>
									</div>
									<div class="text-right">
										<button type="submit" class="btn btn-primary">{{ ('Update') }}</button>
									</div>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
    </div>

	@push('script')
		<script src="{{ asset('admin/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
	@endpush
    
@endsection