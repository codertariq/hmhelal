@php
$route = 'admin.transaction.expense.';
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
                {{ Form::label('trans_date', _lang('date') , ['class' => 'col-form-label required']) }}
                {{ Form::text('trans_date', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('date'), 'required' => '']) }}
            </div>
          </div>
           <div class="col-lg-6">
            <div class="form-group">
               {{ Form::label('bank_id', _lang('account') , ['class' => 'col-form-label']) }}
                {{ Form::select('bank[id]',$bank,null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('account'), 'data-parsley-errors-container' => '#client_category_error']) }}
                <span id="client_category_error"></span>
            </div>
             </div>
           </div>
    </div>
    <div class="row">

            <div class="col-lg-6">
              <div class="form-group">
                {{ Form::label('chart_account_id', _lang('expense_type') , ['class' => 'col-form-label required']) }}
                {{ Form::select('chart_account[id]',$chartaccount, null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('expense_type'), 'required' => '', 'data-parsley-errors-container' => '#parsley_district_error_area']) }}
                <span id="parsley_district_error_area"></span>
            </div>
        </div>

            <div class="col-lg-6">
              <div class="form-group">
                {{ Form::label('payee_payer_id', _lang('payer') , ['class' => 'col-form-label required']) }}
                {{ Form::select('payee_payer[id]',$payeepayer, null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('payer'), 'required' => '', 'data-parsley-errors-container' => '#parsley_district_error_area']) }}
                <span id="parsley_district_error_area"></span>
            </div>
        </div>

    </div>
    <div class="row">

         <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('amount', _lang('Amount') , ['class' => 'col-form-label required']) }}
                {{ Form::text('amount', Null, ['class' => 'form-control', 'placeholder' =>  _lang('Amount'), 'required' => '']) }}
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('reference', _lang('Reference') , ['class' => 'col-form-label']) }}
                {{ Form::text('reference', Null, ['class' => 'form-control', 'placeholder' =>  _lang('Reference')]) }}
            </div>
        </div>
        
    </div>

    <div class="row">
      
        <input type="hidden" name="trans_type" value="expense">
        <input type="hidden" name="dr_cr" value="dr">

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