@php
$route = 'admin.account.';
@endphp
@if(isset($model))
{!! Form::model($model, ['route' => [$route.'update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT', 'files' => true]) !!}
@else
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
@endif
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('Create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('account_name', _lang('account_name') , ['class' => 'col-form-label required']) }}
                {{ Form::text('account_name', Null, ['class' => 'form-control', 'placeholder' =>  _lang('account_name'), 'required' => '']) }}
            </div>
        </div>

          <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('opening_balance', _lang('opening_balance') , ['class' => ' col-form-label']) }}

                {{ Form::text('opening_balance', Null, ['class' => 'form-control', 'placeholder' =>  _lang('opening_balance')]) }}
            </div>
        </div>
    </div>
    <div class="row">
       <div class="col-lg-12">
           <div class="form-group">
                {{ Form::label('note', _lang('note') , ['class' => 'col-form-label']) }}
                {{ Form::textarea('note', Null, ['class' => 'form-control', 'placeholder' =>  _lang('note'), 'style' => 'resize: none;', 'rows' => '3']) }}
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