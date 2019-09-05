<h3 class="text-center"> {{_lang('number_of_transaction')}} <span class="badge badge-primary">{{$model->transaction->count()}}</span></h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>{{_lang('transaction_date')}}</td>
			<td>{{_lang('bank/cash')}}</td>
			<td>{{_lang('transaction_type')}}</td>
			<td>{{_lang('account_type')}}</td>
			<td>{{_lang('amount')}}</td>
		</tr>
	</thead>
	<tbody>
		@foreach($model->transaction as $trans)
 			<tr>
 			    <td>{{$trans->trans_date}}</td>
 				<td>{{$trans->bank->account_name}}</td>
 				<td>{{$trans->trans_type}}</td>
 				<td>{{$trans->payee_payer->name}}</td>
 				<td>{{$trans->amount}}</td>
 			</tr>
		@endforeach	
		<tr>
			<td colspan="1" class="text-center"><b>{{_lang('total')}}</b></td>
			<td>{{$model->opening_balance}}</td>
			<td>{{_lang('opening_balance')}}</td>
			<td>{{$model->transaction->sum('amount')}}</td>
			<td>{{$model->opening_balance+$model->transaction->sum('amount')}}</td>
		</tr>
	</tbody>
</table>