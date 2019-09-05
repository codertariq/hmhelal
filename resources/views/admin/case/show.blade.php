@php
$route = 'admin.cases.';
$js = ['case'];
@endphp
{{-- Available Modal Size = xs, sm, lg, full --}}
@extends('layouts.app', ['title' => _lang('cases_details'), 'modal' => 'full'])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('home') }}</a>
				<span class="breadcrumb-item active">{{ _lang('Cases') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')

<div class="card border-top-success rounded-top-0">
		<div class="card-header header-elements-inline">
			<h6 class="card-title">{{_lang('cases_details')}}</h6>
			<div class="header-elements">
				<div class="list-icons">
	        		<a class="list-icons-item" data-action="collapse"></a>
	        		<a class="list-icons-item" data-action="reload"></a>
	        		<a class="list-icons-item" data-action="remove"></a>
	        	</div>
	    	</div>
		</div>

		<div class="card-body">
			<ul class="nav nav-pills nav-justified">
				<li class="nav-item"><a href="#justified-rounded-pill1" class="nav-link rounded-round active" data-toggle="tab">{{_lang('details')}}</a></li>
				<li class="nav-item"><a href="#justified-rounded-pill2" class="nav-link rounded-round" data-toggle="tab">{{_lang('client')}}</a></li>
				<li class="nav-item"><a href="#justified-rounded-pill3" class="nav-link rounded-round" data-toggle="tab">{{_lang('hearing_date')}}</a></li>
				<li class="nav-item"><a href="#justified-rounded-pill4" class="nav-link rounded-round" data-toggle="tab">{{_lang('payment')}}</a></li>
				<li class="nav-item"><a href="#justified-rounded-pill5" class="nav-link rounded-round" data-toggle="tab">{{_lang('case_study')}}</a></li>
			
			</ul>

			<div class="tab-content">
				<div class="tab-pane fade show active" id="justified-rounded-pill1">
				
				<!-- Custom table color -->
				<div class="card">

					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-dark bg-slate-600">
							<thead>
								<tr>
									<th>
									{{_lang('title')}} : <b>{{$case->title}}</b>
									</th>
									<th>
									 {{_lang('case_no')}} : <b>{{$case->case_no}}</b>	
									</th>
									<th>
									{{ _lang('case_category')}}: <b>
									
										@foreach ($case->case_categories as $filecase)
											 <span class="badge badge-primary">{{$filecase->category->name}}</span> 
										@endforeach
									</b>
									</th>
								</tr>
								<tr>
									<th>
									{{_lang('client')}} : <b>{{$case->client->name}}</b>
									</th>
									<th>
									 {{_lang('client_category')}} : <b>{{$case->client_category->name}}</b>	
									</th>
									<th>
									{{ _lang('court_category')}}: <b>{{$case->court->court_category->name}}</b>	
									</th>
								  </tr>
								  <tr>
									<th>
									{{_lang('court')}} : <b>{{$case->client->name}}</b>
									</th>
									<th>
									 {{_lang('case_stage')}} : <b>{{$case->case_stage->name}}</b>	
									</th>
									<th>
									{{ _lang('act')}}: <b>
										@foreach ($case->case_act as $act)
											 <span class="badge badge-primary">{{$act->actname->name}}</span> 
										@endforeach
									</b>	
									</th>
								</tr>
									<tr>
									<th>
									{{_lang('filing_date')}} : <b>{{$case->filling_date}}</b>
									</th>
									<th>
									 {{_lang('first_hearing_date')}} : <b>{{$case->first_hearing_date}}</b>	
									</th>
									<th>
									{{ _lang('opposite_lawyer')}}: <b>{{$case->opposite_lawyer}}
									</b>	
									</th>
								</tr>

									<tr>
									<th>
									{{_lang('thana')}} : <b>{{$case->thana}}</b>
									</th>
									<th>
									 {{_lang('reference')}} : <b>{{$case->denemee}}</b>	
									</th>
									<th>
									{{ _lang('file_number')}}: <b>{{$case->file_no}}
									</b>	
									</th>
								</tr>
							</thead>
						</table>
					</div>
					</div>

				
				</div>
				<!-- /custom table color -->
				</div>

				<div class="tab-pane fade" id="justified-rounded-pill2">
					<div class="card">
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-dark table-bordered table-striped table-hover bg-info-700">
							<thead>
								
								<tr>
									<th>
									{{_lang('client')}} : <b>{{$case->client->name}}</b>
									</th>
									<th>
									 {{_lang('client_category')}} : <b>{{$case->client_category->name}}</b>	
									</th>
									<th>
									{{ _lang('division')}}: <b>{{$case->client->division?$case->client->division->name:''}}</b>	
									</th>
								  </tr>
								  <tr>
									<th>
									{{_lang('district')}} : <b>{{$case->client->district?$case->client->district->name:''}}</b>
									</th>
									<th>
									 {{_lang('gender')}} : <b>{{$case->client->gender}}</b>	
									</th>
									<th>
									{{ _lang('mobile')}}: <b>
										{{$case->client->mobile}}
									</b>	
									</th>
								</tr>
									<tr>
									<th>
									{{_lang('email')}} : <b>{{$case->client->email}}</b>
									</th>
									<th>
									 {{_lang('address')}} : <b>{{$case->client->address}}</b>	
									</th>
								</tr>
							</thead>
						</table>
					</div>
					</div>

				
				</div>
				</div>

				<div class="tab-pane fade" id="justified-rounded-pill3">
					<div class="row">
					<div class="col-lg-12">
		                
	                	<!-- Left buttons -->
			            <div class="card">
							<div class="card-header header-elements-inline">
				                <h6 class="card-title">{{_lang('next_hearing_information')}}</h6>
							</div>

			                <div class="card-body">
			                	{!! Form::open(['route' => $route.'hearing-date', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
			                	<input type="hidden" name="case_id" value="{{$case->id}}">
									<div class="form-group row">
									     {{ Form::label('date', _lang('hearing_date') , ['class' => 'col-form-label col-lg-2 required']) }}
									     <div class="col-lg-10 ml-lg-auto">
               							 {{ Form::text('date', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('hearing_date'), 'required' => '']) }}
										</div>
										</div>

									<div class="form-group row">
										  {{ Form::label('note', _lang('note') , ['class' => 'col-form-label col-lg-2']) }}
										  <div class="col-lg-10 ml-lg-auto">
               							{{ Form::textarea('note', Null, ['class' => 'form-control', 'placeholder' =>  _lang('note'), 'style' => 'resize: none;', 'rows' => '3']) }}
               							</div>
									</div>

									<div class="form-group row">
										 {{ Form::label('file', _lang('file') , ['class' => 'col-form-label col-lg-2']) }} 
										<div class="col-lg-10">
											 {{ Form::file('file', ['class' => 'form-control-file']) }}
										</div>
									</div>

									<div class="form-group row mb-0">
										<div class="col-lg-10 ml-lg-auto">
											<button type="submit" class="btn btn-light">{{_lang('cancel')}}</button>
											<button type="submit" class="btn bg-blue ml-3">X{{_lang('submit')}} <i class="icon-paperplane ml-2"></i></button>
											<button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
										</div>
									</div>
								{!! Form::close() !!}
							</div>
		                </div>

		             <div class="card">
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-dark table-bordered table-striped table-hover bg-info-700">
							<thead>
								<tr>
									<th>{{_lang('next_date')}}</th>
									<th>{{_lang('note')}}</th>
									<th>{{_lang('attachment')}}</th>
									<th>{{_lang('action')}}</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($case->hearing as $nextdate)
									<tr>
										<td>{{$nextdate->date}}</td>
										<td>{{str_limit($nextdate->note,100)}}</td>
										<td>
										   @if ($nextdate->file)
										   	<a href="{{asset('/storage/case/file/'.$nextdate->file)}}"><i class="icon-download7"></i></a>
										   	@else
										   	<span class="badge badge-danger">{{_lang('no_attachment')}}</span>
										   	@endif	
										</td>
										<td>
										 @if ($nextdate->file)
											<a href="" class="btn btn-info" id="content_managment" data-url="{{ route($route.'preview', $nextdate->id )}}"><i class="icon-play3"></i></a>
										 @endif	
											<a href="" class="btn btn-danger" id="delete_item" data-url="{{ route($route.'hear-destroy', $nextdate->id )}}"><i class="icon-trash"></i> </a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					</div>

				
				</div>
		               </div>
		             </div>
				</div>

				<div class="tab-pane fade" id="justified-rounded-pill4">
					      <div class="card">
							<div class="card-header header-elements-inline">
				                <h6 class="card-title text-left">{{_lang('payment_information')}}</h6>
				                 <h6 class="card-title text-right">{{_lang('total_fees')}} : <b>{{$case->fees}} {!!get_option('currency')!!}</b></h6>


							</div>

			                <div class="card-body">
			                	{!! Form::open(['route' => $route.'payment', 'class' => 'form-validate-jquery ajax_form', 'files' => true, 'method' => 'POST']) !!}
			                	<input type="hidden" name="case_id" value="{{$case->id}}">
									<div class="form-group row">
									     {{ Form::label('invoice_no', _lang('invoice_no') , ['class' => 'col-form-label col-lg-2 required']) }}
									     <div class="col-lg-10 ml-lg-auto">
               							 {{ Form::text('invoice_no', mt_rand(1000000, 9999999), ['class' => 'form-control', 'placeholder' =>  _lang('invoice_no'), 'required' => '','readonly'=>'']) }}
										</div>
										</div>

										<div class="form-group row">
									     {{ Form::label('date', _lang('date') , ['class' => 'col-form-label col-lg-2 required']) }}
									     <div class="col-lg-10 ml-lg-auto">
               							 {{ Form::text('date', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('date'), 'required' => '']) }}
										</div>
										</div>

										<div class="form-group row">
									     {{ Form::label('mode', _lang('peyment_mode') , ['class' => 'col-form-label col-lg-2 required']) }}
									     <div class="col-lg-10 ml-lg-auto">
               							{{ Form::select('mode',['Cash' => 'Cash','Bank'=>'Bank'], null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('peyment_mode'), 'required' => '', 'data-parsley-errors-container' => '#parsley_district_error_area']) }}
                                        <span id="parsley_district_error_area"></span>
										</div>
										</div>

									<div class="form-group row">
									     {{ Form::label('amount', _lang('amount') , ['class' => 'col-form-label col-lg-2 required']) }}
									     <div class="col-lg-10 ml-lg-auto">
               							 {{ Form::text('amount', Null, ['class' => 'form-control', 'placeholder' =>  _lang('amount'), 'required' => '']) }}
										</div>
										</div>

									<div class="form-group row mb-0">
										<div class="col-lg-10 ml-lg-auto">
											<button type="submit" class="btn btn-light">{{_lang('cancel')}}</button>
											<button type="submit" class="btn bg-blue ml-3">{{_lang('submit')}} <i class="icon-paperplane ml-2"></i></button>
											<button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
										</div>
									</div>
								{!! Form::close() !!}
							</div>
		                </div>

		             <div class="card">
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-dark bg-teal">
							<thead>
								<tr>
									<th>{{_lang('invoice_no')}}</th>
									<th>{{_lang('amount')}}</th>
									<th>{{_lang('mode')}}</th>
									<th>{{_lang('date')}}</th>
									<th>{{_lang('action')}}</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($case->case_payment as $allpayment)
									<tr>
										<td>{{$allpayment->invoice_no}}</td>
										<td>{{$allpayment->amount}} {!!get_option('currency')!!}
										</td>
										<td>
										{{$allpayment->mode}}	
										</td>
										<td>
											{{$allpayment->date}}
										</td>
										<td>
											<a href="{{ route($route.'invoice', $allpayment->id )}}" class="btn btn-info" target="_blank"><i class="icon-list2"></i></a>
											<a href="" class="btn btn-danger" id="delete_item" data-url="{{ route($route.'payment-destroy', $allpayment->id )}}"><i class="icon-trash"></i> </a>
										</td>
									</tr>
								@endforeach
								<tr>
									<td colspan="2">{{_lang('total_fees')}} :{{$case->fees}} {!!get_option('currency')!!}</td>
									<td colspan="2">{{_lang('total_pay')}} :{{$case->case_payment->sum('amount')}} {!!get_option('currency')!!}</td>

									<td colspan="2">{{_lang('due')}} :{{$case->fees-$case->case_payment->sum('amount')}} {!!get_option('currency')!!}</td>
								</tr>
							</tbody>
						</table>
					</div>
					</div>

				
				</div>
				</div>

				<div class="tab-pane fade" id="justified-rounded-pill5">
				  <div class="card">
					<div class="card-body">
					   <div>
					   	{!! Form::open(['route' => $route.'study', 'class' => 'form-validate-jquery case', 'files' => true, 'method' => 'POST']) !!}
			                	<input type="hidden" name="case_id" value="{{$case->id}}">
			                		<div class="form-group row">
										  {{ Form::label('note', _lang('note') , ['class' => 'col-form-label col-lg-2']) }}
										  <div class="col-lg-10 ml-lg-auto">
               							{{ Form::textarea('note', Null, ['class' => 'form-control', 'placeholder' =>  _lang('note'), 'style' => 'resize: none;', 'rows' => '3']) }}
               							</div>
									</div>


									<div class="form-group row mb-0">
										<div class="col-lg-10 ml-lg-auto">
											<button type="submit" class="btn btn-light">{{_lang('cancel')}}</button>
											<button type="submit" class="btn bg-blue ml-3">{{_lang('submit')}} <i class="icon-paperplane ml-2"></i></button>
											<button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
										</div>
									</div>
			              {!! Form::close() !!}  	
					   </div>
					   <br> <hr>
						<div class="table-responsive">
						<table class="table  table-bordered">
							<thead>
								<tr>
									<th>{{_lang('note')}}</th>
								</tr>
							</thead>
                          @foreach ($case->case_study as $study)
                          	<tr>
                          		<td>{{$study->note}}</td>
                          	</tr>
                          @endforeach
							<tbody>
							</tbody>
						</table>
					</div>
					</div>

				
				</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>

@stop
@push('scripts')
<!-- Theme JS files -->
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/select.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
@if ($js != '')
@forelse ($js as $element)
<script src="{{ asset('js/pages/'.$element.'.js') }}"></script>
@empty
@endforelse
@endif
<!-- /theme JS files -->
@endpush