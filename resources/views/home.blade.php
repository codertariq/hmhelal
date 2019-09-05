{{-- {{ dd(auth()->user()->getProfile()) }} --}}
@extends('layouts.app', ['title' => _lang('dashboard'), 'modal' => 'full'])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> {{ _lang('home') }}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                {{_lang('case')}}
                </button>
               <button type="button" class="btn btn-light" id="spinner-light-6">
                    {{count(App\Models\Cases::all())}}
                </button>

                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                <a href="{{ route('admin.cases.index') }}" target="_blank" title="{{ _lang('clik_here') }}" data-popup="tooltip" data-placement="bottom">
                <i class="icon-briefcase3
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                </a>

                <div>{{_lang('case_list_update')}} </div>
            </div>
        </div>
    </div>
       <div class="col-md-4">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                {{_lang('case')}}
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  {{count(App\Models\Cases::all())}}  
                </button>

                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                 <a href="" id="content_managment" data-url="{{route('admin.cases.create')}}" title="{{ _lang('clik_here') }}" data-popup="tooltip" data-placement="bottom">
                     <i class="icon-briefcase3
                ec01 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 </a>
                <div>{{_lang('new_case_entry')}} </div>
            </div>
        </div>
    </div>

       <div class="col-md-4">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title"><button type="button" class="btn btn-light" id="spinner-light-6">
                <i class="icon-spinner9 spinner mr-2"></i>
                {{_lang('client')}}
                </button>
                <button type="button" class="btn btn-light" id="spinner-light-6">
                  {{count(App\Models\Client::all())}} 
                </button>

                </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
              <a href="{{ route('admin.client.index') }}" title="{{ _lang('clik_here') }}" data-popup="tooltip" data-placement="bottom" target="_blank">
                  <i class="icon-users2 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
              </a>
                <div>{{_lang('client_list')}} </div>
            </div>
        </div>
    </div>
    </div>
    <div class="card border-top-success rounded-top-0">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<div class="card-body">
		<div class="row">
        <div class="col-lg-12">
            {!! $chart->html() !!}
        </div>      
        </div>
		</div>
	</div>
	</div>

	 <div class="card border-top-success rounded-top-0">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<div class="card-body">
        <div class="row">
        <div class="col-lg-12">
             {!! $line->html() !!}
        </div>      
        </div>
		   
		</div>
	</div>
	</div>
<!-- /basic initialization -->
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $line->script() !!}
@stop
@push('scripts')
<script src="{{ asset('js/pages/case.js') }}"></script>
<!-- /theme JS files -->
@endpush