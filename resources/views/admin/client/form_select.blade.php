@php
$route = 'admin.client.';
@endphp
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' =>  $data['form_id'], 'files' => true, 'method' => 'POST']) !!}
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{ _lang('create') }} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('name', _lang('client_name') , ['class' => 'col-form-label required']) }}
                {{ Form::hidden('target', 'client', ['id' => 'target']) }}
                {{ Form::hidden('status', 1, ['id' => 'status']) }}
                {{ Form::text('name', isset($data['name']) ? $data['name'] : Null, ['class' => 'form-control', 'placeholder' =>  _lang('client_name'), 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('mobile', _lang('mobile') , ['class' => 'col-form-label required']) }}
                {{ Form::text('mobile', Null, ['class' => 'form-control', 'placeholder' =>  _lang('mobile'), 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            {{ Form::submit(_lang('create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger"  id="back_to_previous" >{{ _lang('back')}} </button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush