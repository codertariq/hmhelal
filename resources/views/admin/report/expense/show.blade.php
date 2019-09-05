@php
$route = 'admin.report.';
$js = ['report'];
@endphp
@extends('layouts.app', ['title' => _lang('expense_report'), 'modal' => 'full'])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<span class="breadcrumb-item active">{{ _lang('expense_report') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="card border-top-success rounded-top-0" id="table_card">

<div class="card-body" id="div1">
<h5 class="text-center m-2"><b>{{_lang('total_expense')}}:</b> {{ date("F d Y",strtotime($date1))}} <b>{{_lang('To')}}</b> {{ date("F d Y",strtotime($date2))}}</h5>
  <table class="table table-bordered">
  	<thead>
  		<tr>
  			<td>{{_lang('date')}}</td>
  			<td>{{_lang('account')}}</td>
  			<td>{{_lang('expense_type')}}</td>
  			<td>{{_lang('payer')}}</td>
  			<td>{{_lang('amount')}}</td>
  		</tr>
  	</thead>
  	<tbody>
  		@foreach ($model as $element)
  			<tr>
  				<td>{{$element->trans_date}}</td>
  				<td>{{$element->bank->account_name}}</td>
  				<td>{{$element->chart_account->name}}</td>
  				<td>{{$element->payee_payer->name}}</td>
  				<td>{{$element->amount}}</td>
  			</tr>
  		@endforeach
  		 <tr>
  			<td colspan="4">{{_lang('total')}}</td>
  			<td>{{$model->sum('amount')}}</td>
  		</tr>
  	</tbody>
  </table>
  </div>
   <div class="text-center">
      <button type="button" class="btn btn-danger rounded-round" onclick="printContent('div1')"><i class="icon-printer2 mr-1"></i>{{_lang('print')}}</button>
    </div>
  </div>
@stop
@push('scripts')
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