@php
$route = 'admin.client.';
$js = ['client'];
@endphp
{{-- Available Modal Size = xs, sm, lg, full --}}
@extends('layouts.app', ['title' => _lang('client_management'), 'modal' => 'full'])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('home') }}</a>
				<span class="breadcrumb-item active">{{ _lang('client_management') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{ _lang('client_management') }}
		<button type="button" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round" id="content_managment" data-url="{{route($route.'create')}}"><i class="icon-stack-plus mr-1"></i> {{ _lang('add_new_client') }}</button>
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>
	<div class="card-body">
		{{-- <div class="text-center">
			<img src="{{ asset('asset/table_loader.gif') }}" id="table_loading" width="100px">
		</div> --}}
		<div id="table_display">
			<table class="table content_managment_table" data-url="{{route($route.'datatable')}}">
				<thead>
					<tr>
						<th>{{ _lang('id') }}</th>
						<th>{{ _lang('name') }}</th>
						<th>{{ _lang('mobile') }}</th>
						<th>{{ _lang('division') }}</th>
						<th>{{ _lang('district') }}</th>
						<th>{{ _lang('status') }}</th>
						<th>{{ _lang('action') }}</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /basic initialization -->
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