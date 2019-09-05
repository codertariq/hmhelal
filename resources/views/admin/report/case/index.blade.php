@php
$route = 'admin.report.';
$js = ['report'];
@endphp
{{-- Available Modal Size = xs, sm, lg, full --}}
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
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">

	<div class="card-body">
		{!! Form::open(['route' => $route.'case', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST','target'=>'_blank']) !!}
		<div class="row">
			<div class="col-lg-6">
			 <div class="form-group">
                {{ Form::label('from', _lang('date_form') , ['class' => 'col-form-label required']) }}
                {{ Form::text('from', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('date_form'), 'required' => '']) }}
            </div>
			</div>

			<div class="col-lg-6">
				<div class="form-group">
                {{ Form::label('to', _lang('date_to') , ['class' => 'col-form-label required']) }}
                {{ Form::text('to', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('date_to'), 'required' => '']) }}
            </div>
			</div>
	
		</div>
		 <div class="form-group row">
        <div class="col-lg-4 offset-lg-8">
            {{ Form::submit(_lang('generate'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
        </div>
      </div>

		{!! Form::close() !!}
	</div>
</div>
<!-- /basic initialization -->
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