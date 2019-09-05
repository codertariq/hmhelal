@php
$route = 'admin.client.';
@endphp
@if(isset($model))
{!! Form::model($model, ['route' => [$route.'update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT', 'files' => true]) !!}
@else
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
@endif
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('name', _lang('client_name') , ['class' => 'col-form-label required']) }}
                {{ Form::text('name', Null, ['class' => 'form-control', 'placeholder' =>  _lang('client_name'), 'required' => '']) }}
            </div>
        </div>

         <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('mobile', _lang('mobile') , ['class' => 'col-form-label required']) }}
                {{ Form::text('mobile', Null, ['class' => 'form-control', 'placeholder' =>  _lang('mobile'), 'required' => '']) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('email', _lang('email') , ['class' => 'col-form-label']) }}
                {{ Form::email('email', Null, ['class' => 'form-control', 'placeholder' =>  _lang('email')]) }}
            </div>
        </div>

         <div class="col-lg-6">
             <div class="form-group">
                {{ Form::label('division', _lang('division') , ['class' => 'col-form-label required']) }}
                {{ Form::select('division[id]', $divisions, isset($model) ? $model->division->id : config('satt.default_division_id'), ['class' => 'form-control select', 'data-placeholder' =>  _lang('division'), 'required' => '', 'id' => 'division', 'data-parsley-errors-container' => '#parsley_division_error_area']) }}
                <span id="parsley_division_error_area"></span>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('district', _lang('district') , ['class' => 'col-form-label required']) }}
                {{ Form::select('district[id]', isset($districts) ? $districts : ['' => 'Select Division First'], null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('district'), 'required' => '', 'id' => 'district', 'data-parsley-errors-container' => '#parsley_district_error_area']) }}
                <span id="parsley_district_error_area"></span>
            </div>
        </div>

         <div class="col-lg-6">
              <div class="form-group">
                {{ Form::label('gender', _lang('gender') , ['class' => 'col-form-label required']) }}
                {{ Form::select('gender',['male' => 'Male','female'=>'Female'], null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('gender'), 'required' => '', 'data-parsley-errors-container' => '#parsley_district_error_area']) }}
                <span id="parsley_district_error_area"></span>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('address', _lang('address') , ['class' => 'col-form-label']) }}
               {{ Form::textarea('address', Null, ['class' => 'form-control', 'placeholder' =>  _lang('address'), 'style' => 'resize: none;', 'rows' => '3']) }}
            </div>
        </div>
    </div>
        <div class="row">
        <div class="col-lg-6">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="" class="form-check-label">{{ _lang('status') }}</label>
                {{-- {{ Form::label('status', _lang('Status') , ['class' => 'col-form-label']) }} --}}

                  <input type="checkbox" name="status" id="status" value="1" class="form-check-input-switchery mt-3" data-fouc {{ (isset($model) and $model) ? $model->status ? 'checked' : '' : 'checked' }}>

            </div>
        </div>

        <div class="col-md-6">
          {{ Form::label('file', _lang('file') , ['class' => 'col-form-label']) }} 
            {{ Form::file('file', ['class' => 'form-control-file']) }}
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