@php
$route = 'admin.cases.';
@endphp
@if(isset($model))
{!! Form::model($model, ['route' => [$route.'update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT', 'files' => true]) !!}
@else
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
@endif
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="title" class="col-form-label">{{ _lang('title') }} <small>(Auto Genarate if leave it empty)</small></label>
                {{ Form::text('title', Null, ['class' => 'form-control', 'placeholder' =>  _lang('title')]) }}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('case_no', _lang('case_no') , ['class' => 'col-form-label required']) }}
                {{ Form::text('case_no', Null, ['class' => 'form-control', 'placeholder' =>  _lang('case_no'), 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('case_category', _lang('case_category') , ['class' => 'col-form-label required']) }}
                {{ Form::select('case_category[id][]', $casecategory,isset($model) && $model->case_categories?$model->case_categories->pluck('case_category_id'):null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('case_category'),'multiple'=>'', 'required' => '', 'data-parsley-errors-container' => '#casecategory_error', 'id' => 'case_category']) }}
                <span id="casecategory_error"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('file_no', _lang('file_number') , ['class' => 'col-form-label required']) }}
                {{ Form::text('file_no', Null, ['class' => 'form-control', 'placeholder' =>  _lang('file_number'), 'required' => '']) }}
            </div>
        </div>
          <div class="col-lg-4">

            <div class="form-group">
                {{ Form::label('act', _lang('act') , ['class' => 'col-form-label required']) }}
                {{ Form::select('act[id][]',$act,isset($model) && $model->case_act?$model->case_act->pluck('act_id'):null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('act'),'multiple'=>'', 'required' => '','data-parsley-errors-container' => '#act_id_error', 'id' => 'act']) }}
                <span id="act_id_error"></span>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('fees', _lang('total_fees') , ['class' => 'col-form-label']) }}
                {{ Form::text('fees', Null, ['class' => 'form-control', 'placeholder' =>  _lang('total_fees')]) }}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                {{ Form::label('client', _lang('client') , ['class' => 'col-form-label required']) }}
                {{ Form::select('client[id]', $client,null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('client'), 'required' => '', 'data-parsley-errors-container' => '#client_id_error', 'id' => 'client']) }}
                <span id="client_id_error"></span>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                {{ Form::label('vs', _lang('v/s') , ['class' => 'col-form-label text-center']) }}
                {{ Form::text('vs', 'v/s', ['class' => 'form-control-plaintext', 'required' => '', 'id' => 'vs', 'disabled' => '']) }}
                <span id="client_id_error"></span>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                {{ Form::label('vs_name', _lang('v/s_name') , ['class' => 'col-form-label']) }}
                {{ Form::text('vs_name',null, ['class' => 'form-control', 'placeholder' =>  _lang('v/s_name'), 'required' => '', 'id' => 'vs_name']) }}
                <span id="client_id_error"></span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('client_category', _lang('client_category') , ['class' => 'col-form-label required']) }}
                {{ Form::select('client_category[id]', $client_category,null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('client_category'), 'required' => '', 'data-parsley-errors-container' => '#client_category_error', 'id' => 'client_category']) }}
                <span id="client_category_error"></span>
            </div>
        </div>
    </div>
    <legend class="text-uppercase font-size-sm font-weight-bold">{{ _lang('court_section') }} </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('court_category', _lang('court_category') , ['class' => 'col-form-label required']) }}
                {{ Form::select('court_category[id]', $court_category,isset($model) ? $model->court_category_id : null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('court_category'), 'required' => '', 'id'=>'court_category', 'data-parsley-errors-container' => '#court_category_error']) }}
                <span id="court_category_error"></span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('court', _lang('court_name') , ['class' => 'col-form-label required']) }}
                {{ Form::select('court[id]',isset($courts) ? $courts : [''=>'Select Category First'], isset($model)? $model->court_id : Null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('court_name'), 'required' => '', 'id'=>'court','data-parsley-errors-container' => '#court_id_error']) }}
                <span id="court_id_error"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('room_no', _lang('room_number') , ['class' => 'col-form-label']) }}
                {{ Form::text('room_no', Null, ['class' => 'form-control', 'placeholder' =>  _lang('room_number')]) }}
            </div>
        </div>
          <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('thana', _lang('thana') , ['class' => 'col-form-label']) }}
                {{ Form::text('thana', Null, ['class' => 'form-control', 'placeholder' =>  _lang('thana')]) }}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('denemee', _lang('reference') , ['class' => 'col-form-label']) }}
                {{ Form::text('denemee', Null, ['class' => 'form-control', 'placeholder' =>  _lang('reference')]) }}
            </div>
        </div>
      <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('opposite_lawyer', _lang('opposite_lawyer') , ['class' => 'col-form-label']) }}
                {{ Form::text('opposite_lawyer', Null, ['class' => 'form-control', 'placeholder' =>  _lang('opposite_lawyer')]) }}
            </div>
        </div>
     
    </div>
    <div class="row">
         <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('filling_date', _lang('filling_date') , ['class' => 'col-form-label required']) }}
                {{ Form::text('filling_date', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('filling_date'), 'required' => '']) }}
            </div>
        </div>

          <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('receiving_date', _lang('receiving_date') , ['class' => 'col-form-label required']) }}
                {{ Form::text('receiving_date', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('receiving_date'), 'required' => '']) }}
            </div>
        </div>

          <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('judgement_date', _lang('judgement_date') , ['class' => 'col-form-label required']) }}
                {{ Form::text('judgement_date', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('judgement_date'), 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('first_hearing_date', _lang('hearing_date') , ['class' => 'col-form-label required']) }}
                {{ Form::text('first_hearing_date', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('hearing_date'), 'required' => '']) }}
            </div>
        </div>
              <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('case_stage', _lang('case_stage') , ['class' => 'col-form-label required']) }}
                {{ Form::select('case_stage[id]',$casestage, null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('case_stage'), 'required' => '','data-parsley-errors-container' => '#case_stage_error', 'id' => 'case_stage']) }}
                <span id="case_stage_error"></span>
            </div>
        </div>
      
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            {{ Form::submit(isset($model) ? _lang('update'):_lang('create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"> {{  _lang('close') }} </button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush