@php
$route = 'admin.report.';
$js = ['report'];
@endphp
@extends('layouts.app', ['title' => _lang('case_report'), 'modal' => 'full'])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<span class="breadcrumb-item active">{{ _lang('case_report') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="card border-top-success rounded-top-0" id="table_card">

<div class="card-body" id="div1">
<h5 class="text-center m-2"><b>{{_lang('total_case')}}:</b> {{ date("F d Y",strtotime($date1))}} <b>{{_lang('To')}}</b> {{ date("F d Y",strtotime($date2))}}</h5>
  <table class="table table-bordered">
  	<thead>
  		<tr>
  			<td>{{_lang('date')}}</td>
  			<td>{{_lang('case_no')}}</td>
  			<td>{{_lang('court_name')}}</td>
  			<td>{{_lang('thana')}}</td>
  			<td>{{_lang('client')}}</td>
  		</tr>
  	</thead>
  	<tbody>
  		@foreach ($model as $element)
  			<tr>
  				<td>{{$element->date}}</td>
  				<td>{{$element->case->case_no}}</td>
  				<td>{{$element->case->court->name}}</td>
  				<td>{{$element->case->thana}}</td>
          @php
            $client=App\Models\Client::where('id',$element->case->client_id)->first();
          @endphp
  				<td>{{$client->name}}</td>
  			</tr>
  		@endforeach
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