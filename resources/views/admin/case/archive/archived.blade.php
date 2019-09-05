@php
$route = 'admin.cases.archived.';
@endphp
<table class="table table-bordered">
   <tr>
       <td>{{_lang('case_no')}} : <b>{{$case->case_no}}</b></td>
       <td>{{_lang('title')}} : <b>{{$case->title}}</b></td>
       <td>{{_lang('client')}} : <b>{{$case->client->name}}</b></td>
   </tr> 
</table>
{!! Form::open(['route' => $route.'archivedpost', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
<fieldset class="mb-3">
    <div class="row">
        <div class="col-lg-12">
        <input type="hidden" name="case_id" value="{{$case->id}}">
            <div class="form-group">
                {{ Form::label('note', _lang('note') , ['class' => 'col-form-label']) }}
               {{ Form::textarea('note', Null, ['class' => 'form-control', 'placeholder' =>  _lang('note'), 'style' => 'resize: none;', 'rows' => '3']) }}
            </div>
        </div>

         <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('closing_date', _lang('closing_date)') , ['class' => 'col-form-label required']) }}
                {{ Form::text('closing_date', Null, ['class' => 'form-control date', 'placeholder' =>  _lang('closing_date)'), 'required' => '']) }}
            </div>
        </div>

    </div>

    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            {{ Form::submit(isset($model) ? _lang('update'):_lang('close_case'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"> {{  _lang('close') }} </button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush