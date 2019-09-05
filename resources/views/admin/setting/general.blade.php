@extends('layouts.app', ['title' => 'setting', 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{_lang('home')}}</span>
                 <span class="breadcrumb-item active"><i class="icon-cog mr-2"></i> {{_lang('setting')}}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
   <div class="row">
   			<div class="col-md-12">
				<div class="card">
					<div class="card-header header-elements-inline">
						<h6 class="card-title">{{_lang('System Configuration')}}</h6>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

					<div class="card-body">
						<ul class="nav nav-tabs nav-tabs-solid nav-justified bg-light">
							<li class="nav-item"><a href="#solid-bordered-justified-tab1" class="nav-link active" data-toggle="tab">{{_lang('general')}}</a></li>
							<li class="nav-item"><a href="#solid-bordered-justified-tab5" class="nav-link" data-toggle="tab">{{_lang('basic')}}</a></li>
							<li class="nav-item"><a href="#solid-bordered-justified-tab2" class="nav-link" data-toggle="tab">{{_lang('logo')}}</a></li>
							<li class="nav-item"><a href="#solid-bordered-justified-tab3" class="nav-link" data-toggle="tab">{{_lang('api')}}</a></li>
							<li class="nav-item"><a href="#solid-bordered-justified-tab4" class="nav-link" data-toggle="tab">{{_lang('social_link')}}</a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane fade show active" id="solid-bordered-justified-tab1">
							{!! Form::open(['route' => 'admin.configuration', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
							<fieldset class="mb-3" id="form_field">
							<div class="row">
							<div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('company_name', _lang('company_name') , ['class' => 'col-form-label ']) }}
								{{ Form::text('company_name', get_option('company_name'), ['class' => 'form-control', 'placeholder' => _lang('company_name')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('site_title', _lang('title') , ['class' => 'col-form-label ']) }}
								{{ Form::text('site_title', get_option('site_title'), ['class' => 'form-control', 'placeholder' => _lang('title')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('email', _lang('Email') , ['class' => 'col-form-label ']) }}
								{{ Form::text('email', get_option('email'), ['class' => 'form-control', 'placeholder' => _lang('Email')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label(_lang('phone'), _lang('phone') , ['class' => 'col-form-label ']) }}
								{{ Form::text('phone',get_option('phone'), ['class' => 'form-control', 'placeholder' => _lang('phone')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('alt_phone', _lang('alernative_phone') , ['class' => 'col-form-label ']) }}
								{{ Form::text('alt_phone', get_option('alt_phone'), ['class' => 'form-control', 'placeholder' => _lang('alernative_phone')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('start_date', _lang('starting_date') , ['class' => 'col-form-label ']) }}
								{{ Form::text('start_date', get_option('start_date'), ['class' => 'form-control pickadate-accessibility', 'placeholder' => _lang('starting_date')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('currency', _lang('currency') , ['class' => 'col-form-label']) }}
								<select name="currency" class="form-control select">
								@foreach (curency() as $key=> $element)
								<option {{get_option('currency')?get_option('currency') ==$key:''? 'selected' : ''}} value="{{$key}}">{!!$element!!}({{$key}})</option>
								@endforeach
								</select>
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('timezone', _lang('timezone') , ['class' => 'col-form-label ']) }}
								<select name="timezone" class="form-control select">
								@foreach (tz_list() as $key=> $time)
								<option  value="{{$time['zone']}}">{{ $time['diff_from_GMT'] . ' - ' . $time['zone']}}</option>
								@endforeach
								</select>
							</div>
						   </div>

						   </div>
						   <div class="row">
						   	<div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('language', _lang('language') , ['class' => 'col-form-label ']) }}
								<select name="language" class="form-control select">
								{!! load_language( get_option('language') ) !!}
								</select>
							</div>
						   </div>

						    <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('land_mark', _lang('land_mark') , ['class' => 'col-form-label']) }}
								{{ Form::text('land_mark', get_option('land_mark'), ['class' => 'form-control', 'placeholder' => _lang('land_mark')]) }}
							</div>
						   </div>

						   	<div class="col-lg-12">
							<div class="form-group">
								{{ Form::label('address', _lang('address') , ['class' => 'col-form-label']) }}
								{{ Form::textarea('address', get_option('address'), ['class' => 'form-control', 'rows'=>3]) }}
							</div>
						   </div>
						   </div>

						    <div class="text-right">
		                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}<i class="icon-arrow-right14 position-right"></i></button>
		                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

		                    </div>

							</fieldset>


							{!!Form::close()!!}
							</div>

							<div class="tab-pane fade" id="solid-bordered-justified-tab2">
							{!! Form::open(['route' => 'admin.logo', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
							 <fieldset class="mb-3" id="form_field">
								<div class="row">

								<div class="col-md-6">
								<div class="form-group">
								{{ Form::label('logo', _lang('logo') , ['class' => 'col-form-label']) }}
								  <input type="file" name="logo">
								   @if(get_option('logo'))
                                    <input type="hidden" name="oldLogo" value="{{get_option('logo')}}">
                                  @endif

							     </div>
								 </div>

							     <div class="col-md-6">
									<div class="form-group">
									{{ Form::label('favicon', _lang('favicon') , ['class' => 'col-form-label']) }}
									  <input type="file" name="favicon">
								   @if(get_option('favicon'))
                                    <input type="hidden" name="oldfavicon" value="{{get_option('favicon')}}">
                                   @endif
							        </div>
								  </div>
								</div>
						    <div class="text-right">
		                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}<i class="icon-arrow-right14 position-right"></i></button>
		                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

		                    </div>
							</fieldset>
							{!!Form::close()!!}
							</div>

							<div class="tab-pane fade" id="solid-bordered-justified-tab3">
								{!! Form::open(['route' => 'admin.api', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
								 <fieldset class="mb-3" id="form_field">
								 <div class="row">

								 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('paypale_client_id', 'Paypale Client Id' , ['class' => 'col-form-label ']) }}
										{{ Form::text('paypale_client_id', get_option('paypale_client_id'), ['class' => 'form-control', 'placeholder' => 'Paypale Client Id']) }}
										</div>
								 	</div>

								 	 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('paypale_client_secret', 'PAYPAL SECRET' , ['class' => 'col-form-label ']) }}
										{{ Form::text('paypale_client_secret', get_option('paypale_client_secret'), ['class' => 'form-control', 'placeholder' => 'PAYPAL_SECRET']) }}
										</div>
								 	</div>
								 </div>

								  <div class="row">
								    <legend>Stripe</legend>
								 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('stripe_key', 'Secret Key' , ['class' => 'col-form-label ']) }}
										{{ Form::text('stripe_key', get_option('stripe_key'), ['class' => 'form-control', 'placeholder' => 'Secret Key']) }}
										</div>
								 	</div>

								 	 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('publish_key', 'Publishable Key' , ['class' => 'col-form-label ']) }}
										{{ Form::text('publish_key', get_option('publish_key'), ['class' => 'form-control', 'placeholder' => 'Publishable Key']) }}
										</div>
								 	</div>
								 </div>

								   <div class="row">
								    <legend>Social Api</legend>
								 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('FACEBOOK_CLIENT_ID:', 'FACEBOOK API' , ['class' => 'col-form-label ']) }}
										{{ Form::text('FACEBOOK_CLIENT_ID', get_option('FACEBOOK_CLIENT_ID'), ['class' => 'form-control', 'placeholder' => 'FACEBOOK API']) }}
										</div>
								 	</div>

								 		<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('FACEBOOK_CLIENT_SECRET', 'FACEBOOK CLIENT SECRET:' , ['class' => 'col-form-label ']) }}
										{{ Form::text('FACEBOOK_CLIENT_SECRET', get_option('FACEBOOK_CLIENT_SECRET'), ['class' => 'form-control', 'placeholder' => 'FACEBOOK_CLIENT_SECRET:']) }}
										</div>
								 	</div>

								 	 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('G+_CLIENT_ID', 'G+ CLIENT ID' , ['class' => 'col-form-label ']) }}
										{{ Form::text('G+_CLIENT_ID', get_option('G+_CLIENT_ID'), ['class' => 'form-control', 'placeholder' => 'G+_CLIENT_ID:']) }}
										</div>
								 	</div>

								 	 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('G+_CLIENT_SECRET', 'G+ CLIENT SECRET' , ['class' => 'col-form-label ']) }}
										{{ Form::text('G+_CLIENT_SECRET', get_option('G+_CLIENT_SECRET'), ['class' => 'form-control', 'placeholder' => 'G+ CLIENT SECRET']) }}
										</div>
								 	</div>
								 </div>
							<div class="text-right">
		                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}<i class="icon-arrow-right14 position-right"></i></button>
		                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

		                    </div>
								 </fieldset>
								{!!Form::close()!!}
							</div>

							<div class="tab-pane fade" id="solid-bordered-justified-tab4">
								{!! Form::open(['route' => 'admin.social', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
								 <fieldset class="mb-3" id="form_field">
								 <div class="row">

								 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('Facebook_link', ' Facebook Link' , ['class' => 'col-form-label ']) }}
										{{ Form::text('Facebook_link', get_option('Facebook_link'), ['class' => 'form-control', 'placeholder' => 'Facebook Link']) }}
										</div>
								 	</div>

								 	 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('twiter_link', 'Twiter Link' , ['class' => 'col-form-label ']) }}
										{{ Form::text('twiter_link', get_option('twiter_link'), ['class' => 'form-control', 'placeholder' => 'Twiter Link']) }}
										</div>
								 	</div>
								 </div>

								  <div class="row">

								 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('youtube_link', 'Youtube Link' , ['class' => 'col-form-label ']) }}
										{{ Form::text('youtube_link', get_option('youtube_link'), ['class' => 'form-control', 'placeholder' => 'Youtube Link']) }}
										</div>
								 	</div>

								 	 	<div class="col-md-6">
								 		<div class="form-group">
										{{ Form::label('google+_link', 'Google+ Link' , ['class' => 'col-form-label ']) }}
										{{ Form::text('google+_link', get_option('google+_link'), ['class' => 'form-control', 'placeholder' => 'Google+ Link']) }}
										</div>
								 	</div>
								 </div>
								<div class="text-right">
			                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}<i class="icon-arrow-right14 position-right"></i></button>
			                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

			                    </div>
								 </fieldset>
								{!!Form::close()!!}
							</div>

							<div class="tab-pane fade" id="solid-bordered-justified-tab5">
							{!! Form::open(['route' => 'admin.basic', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
								 <fieldset class="mb-3" id="form_field">
								  <div class="row">

								 	<div class="col-md-12">
								 		<div class="form-group">
										{{ Form::label('owner_name', ' owner_name' , ['class' => 'col-form-label ']) }}
										{{ Form::text('owner_name', get_option('owner_name'), ['class' => 'form-control', 'placeholder' => 'owner_name']) }}
										</div>
								 	</div>

								 	 	<div class="col-md-12">
								 		<div class="form-group">
										{{ Form::label('education', _lang('education') , ['class' => 'col-form-label']) }}
								       {{ Form::textarea('education', get_option('education'), ['class' => 'form-control', 'rows'=>3]) }}
										</div>
								 	</div>
								 </div>
								 	<div class="text-right">
				                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_basic')}}<i class="icon-arrow-right14 position-right"></i></button>
				                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

			                    </div>
								 </fieldset>
							{!!Form::close()!!}	 
							</div>

						</div>
					</div>
				</div>
			</div>
    </div>
<!-- /basic initialization -->
@stop
@push('scripts')
<!-- Theme JS files -->
<script src="{{ asset('js/setting.js') }}"></script>
<!-- /theme JS files -->
@endpush