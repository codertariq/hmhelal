<?php

namespace App\Http\Controllers\admin\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Transaction;
use App\Models\Bank;
use App\Models\ChartAccount;
use App\Models\PayeePayer;
use Validator;
use Illuminate\Validation\Rule;
use Auth;

class TransactionController extends Controller
{
    protected $view;
  	public function __construct() {
		$this->view = 'admin.transaction.';
	}
	private function route() {
		return 'admin.transaction.';
	}

   	public function index(Request $request)
	{
		if ($request->segment(3)=='income') {
		if (!auth()->user()->can('income.view')) {
            abort(403, 'Unauthorized action.');
        }
	     return view($this->view . 'income.index');
	    }

	     else
	     {
	     	if (!auth()->user()->can('expense.view')) {
            abort(403, 'Unauthorized action.');
        	}
	      return view($this->view . 'expense.index');	
	     }
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function datatable(Request $request) {
		if ($request->ajax()) {
			if ($request->segment(3)=='income') {

				if (!auth()->user()->can('income.view')) {
           			 abort(403, 'Unauthorized action.');
       			 }
			$income = Transaction::where('trans_type','income')->get();
			return Datatables::of($income)
				->addIndexColumn()
				->editColumn('bank_id', function ($model) {
					return '<strong>' . $model->bank->account_name . '</strong>';
				})
				->addColumn('amount', function ($model) {
					return  $model->amount ;
				})
				->editColumn('chart_account_id', function ($model) {

					return  $model->chart_account->name ;
				})

				->editColumn('payee_payer_id', function ($model) {

					return  $model->payee_payer->name ;
				})

				->addColumn('action', function ($model) {
				$route = $this->route().'income.';
				return view($this->view.'income.action', compact('model', 'route'));
			})
				->rawColumns(['action','bank_id'])->make(true);


		}
		elseif ($request->segment(3)=='expense') {
			if (!auth()->user()->can('expense.view')) {
            abort(403, 'Unauthorized action.');
        	}
				$expense = Transaction::where('trans_type','expense')->get();
			   return Datatables::of($expense)
				->addIndexColumn()
				->editColumn('bank_id', function ($model) {
					return '<strong>' . $model->bank->account_name . '</strong>';
				})
				->addColumn('amount', function ($model) {
					return  $model->amount ;
				})
				->editColumn('chart_account_id', function ($model) {

					return  $model->chart_account->name ;
				})

				->editColumn('payee_payer_id', function ($model) {

					return  $model->payee_payer->name ;
				})

				->addColumn('action', function ($model) {
				$route = $this->route().'expense.';
				return view($this->view.'expense.action', compact('model', 'route'));
			})
				->rawColumns(['action','bank_id'])->make(true);
		}

	}
	else {
			return abort(404);
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function expensedatatable(Request $request) {
		if ($request->ajax()) {
			$income = Transaction::where('trans_type','income')->get();
			return Datatables::of($income)
				->addIndexColumn()
				->editColumn('bank_id', function ($model) {
					return '<strong>' . $model->bank->account_name . '</strong>';
				})
				->addColumn('amount', function ($model) {
					return  $model->amount ;
				})
				->editColumn('chart_account_id', function ($model) {

					return  $model->chart_account->name ;
				})

				->editColumn('payee_payer_id', function ($model) {

					return  $model->payee_payer->name ;
				})

				->addColumn('action', function ($model) {
				$route = $this->route().'income.';
				return view($this->view.'income.action', compact('model', 'route'));
			})
				->rawColumns(['action','bank_id'])->make(true);
		} else {
			return abort(404);
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		if (!auth()->user()->can(['expense.create','income.create'])) {
            abort(403, 'Unauthorized action.');
        	}
		if (!$request->ajax()) {
			return abort(404);
		} 
		if ($request->segment(3)=='income') {
		 	# code...
		return view($this->view . 'income.form', $this->preRequisite('income'));
		 } 

		else{
		return view($this->view . 'expense.form', $this->preRequisite('expense'));	
		} 
		// return view($this->view.'income.form',compact('bank','chartaccount','payeepayer'));
	}

	public function preRequisite($type,$id=null)
	{
		if ($type=="income") {
     	$bank =Bank::all()->pluck('account_name','id')->prepend(_lang('Select One'), '');
		$chartaccount =ChartAccount::where('type','income')->pluck('name','id')->prepend(_lang('Select One'), '');
		$payeepayer =PayeePayer::where('type','payer')->get()->pluck('name','id')->prepend(_lang('Select One'), '');
		$compact = compact('bank','chartaccount','payeepayer');
		if ($id) {
			$trans =Transaction::findOrFail($id);
			$compact = compact('bank','chartaccount','payeepayer','trans');
		}
		return $compact;
	}
	elseif($type=='expense')
	{
		$bank =Bank::all()->pluck('account_name','id')->prepend(_lang('Select One'), '');
		$chartaccount =ChartAccount::where('type','expense')->pluck('name','id')->prepend(_lang('Select One'), '');
		$payeepayer =PayeePayer::where('type','Payee')->get()->pluck('name','id')->prepend(_lang('Select One'), '');
		$compact = compact('bank','chartaccount','payeepayer');
		if ($id) {
			$trans =Transaction::findOrFail($id);
			$compact = compact('bank','chartaccount','payeepayer','trans');
		}
		return $compact;
	}
	}

	/**
	 * Store the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request) {
		if (!auth()->user()->can(['expense.create','income.create'])) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$validator = $request->validate([
				'trans_date' => ['required', 'date'],
				'bank.id' => ['required', 'integer'],
				'chart_account.id' =>['required', 'integer'],
				'payee_payer.id' =>['required', 'integer'],
				'amount' =>['required', 'numeric'],
			]);

		$trans =new Transaction;
		$trans->trans_date =$request->trans_date;
		$trans->bank_id =$request->bank['id'];
		$trans->chart_account_id =$request->chart_account['id'];
		$trans->amount =$request->amount;
		$trans->dr_cr =$request->dr_cr;
		$trans->trans_type =$request->trans_type;
		$trans->payee_payer_id =$request->payee_payer['id'];
		$trans->create_user_id =Auth::user()->id;
		$trans->update_user_id =Auth::user()->id;
		$trans->reference =$request->reference;
		$trans->note =$request->note;
		$trans->save();

	return $this->success(['message' => _lang($request->trans_type.'added_successfull.')]);
	}
	 else {
			return abort(404);
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function income_edit(Request $request,$id) {
		if (!auth()->user()->can(['expense.update','income.update'])) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$model = Transaction::findOrFail($id);
			if ($request->segment(3)=='income') {
			return view($this->view . 'income.form',$this->preRequisite('income',$id), compact('model'));
		}
		elseif($request->segment(3)=='expense')
		{
		 return view($this->view . 'expense.form',$this->preRequisite('expense',$id), compact('model'));
		}
		} else {
			return abort(404);
		}
	}

		/**
	 * Update the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function update(Request $request,$id) {
		if (!auth()->user()->can(['expense.update','income.update'])) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$validator = $request->validate([
				'trans_date' => ['required', 'date'],
				'bank.id' => ['required', 'integer'],
				'chart_account.id' =>['required', 'integer'],
				'payee_payer.id' =>['required', 'integer'],
				'amount' =>['required', 'numeric'],
			]);

		$trans =Transaction::findOrFail($id);
		$trans->trans_date =$request->trans_date;
		$trans->bank_id =$request->bank['id'];
		$trans->chart_account_id =$request->chart_account['id'];
		$trans->amount =$request->amount;
		$trans->dr_cr =$request->dr_cr;
		$trans->trans_type =$request->trans_type;
		$trans->payee_payer_id =$request->payee_payer['id'];
		$trans->create_user_id =Auth::user()->id;
		$trans->update_user_id =Auth::user()->id;
		$trans->reference =$request->reference;
		$trans->note =$request->note;
		$trans->save();

	return $this->success(['message' => _lang($request->trans_type.' update_successfull.')]);
	}
	 else {
			return abort(404);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
			
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request,$id) {
		if (!auth()->user()->can(['expense.delete','income.delete'])) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$model = Transaction::findOrFail($id);
			$model->delete();
			return $this->success(['message' => _lang($model->trans_type.' delete_successfull')]);
		} else {
			return abort(404);
		}
	}

	/**
	 * Selected Datatable Row Action the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function action(Request $request) {
		if (!auth()->user()->can(['expense.delete','income.delete'])) {
            abort(403, 'Unauthorized action.');
        	}
		//$this->authorize('status', $this->repo->model());
		if ($request->ajax()) {
			$ids =$request->ids;
		foreach ($ids as $id) {
			$model = Transaction::findOrFail($id)->delete();
		}
			return $this->success(['message' => _lang('delete_successfull')]);
		} else {
			return abort(404);
		}
	}

}
