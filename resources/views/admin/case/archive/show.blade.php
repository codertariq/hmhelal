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
				<span class="breadcrumb-item active">{{ _lang('cases') }}</span>
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
			
			</ul>

			<div class="tab-content">
				<div class="tab-pane fade show active" id="justified-rounded-pill1">
				
				<!-- Custom table color -->
				<div class="card">

					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered">
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
									{{ _lang('Act')}}: <b>
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
						<table class="table table-bordered">
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
		             <div class="card">
					<div class="card-body">
						<div class="table-responsive">
						<table class="table table-bordered ">
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