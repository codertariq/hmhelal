<?php

namespace App\Http\Controllers\admin\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Bank;
use Validator;
use Illuminate\Validation\Rule;
use Auth;

class BankController extends Controller
{
	private function route() {
		return 'admin.account.';
	}
	public function index()
	{
	 if (!auth()->user()->can('bank.view')) {
            abort(403, 'Unauthorized action.');
        }
	  return view('admin.bank.index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function datatable(Request $request) {
		if (!auth()->user()->can('bank.view')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$banks = Bank::all()->sortByDesc("id");
			return Datatables::of($banks)
				->addIndexColumn()
				->editColumn('account_name', function ($model) {
					return '<strong>' . $model->account_name . '</strong>';
				})
				->addColumn('opening_balance', function ($model) {
					return  $model->opening_balance ;
				})
				->editColumn('note', function ($model) {

					return  $model->note ;
				})
				->addColumn('action', function ($model) {
				$route = $this->route();
				return view('admin.bank.action', compact('model', 'route'));
			})
				->rawColumns(['action','account_name'])->make(true);
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
		if (!auth()->user()->can('bank.create')) {
            abort(403, 'Unauthorized action.');
        }
		if (!$request->ajax()) {
			return abort(404);
		}  
		return view('admin.bank.form');
	}

	/**
	 * Store the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request) {
		if (!auth()->user()->can('bank.create')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$validator = $request->validate([
				'account_name' => ['required', 'max:255'],
				'opening_balance' => ['sometimes', 'nullable','numeric'],
			]);

			$bank =new Bank;
			$bank->account_name =$request->account_name;
			$bank->opening_balance =$request->opening_balance;
			$bank->note =$request->note;
			$bank->create_user_id = Auth::user()->id;
			$bank->save();
			return $this->success(['message' => _lang('account/bank_add_successfully.')]);
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
	public function edit(Request $request,$id) {
		if (!auth()->user()->can('bank.update')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$model = Bank::findOrFail($id);
			return view('admin.bank.form', compact('model'));
		} else {
			return abort(404);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		if (!auth()->user()->can('bank.update')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$validator = $request->validate([
				'account_name' => ['required', 'max:255'],
				'opening_balance' => ['sometimes', 'nullable','numeric'],
			]);
		    $bank =Bank::findOrFail($id);
			$bank->account_name =$request->account_name;
			$bank->opening_balance =$request->opening_balance;
			$bank->note =$request->note;
			$bank->create_user_id = Auth::user()->id;
			$bank->save();
			return $this->success(['message' => _lang('account/bank_update_successfully.')]);
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
	public function show(Request $request,$id) {
		if (!auth()->user()->can('bank.view')) {
            abort(403, 'Unauthorized action.');
        }

	 if ($request->ajax()) {
       $model =Bank::with('transaction')->findOrFail($id);
       return view('admin.bank.show',compact('model'));

      }
      else {
			return abort(404);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request,$id) {
		if (!auth()->user()->can('bank.delete')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$model = Bank::findOrFail($id);
			if ($model->transaction()->count()) {
			throw ValidationException::withMessages(['message' => _lang('Bank/Cash Account associate')]);
		     }
			$model->delete();
			return $this->success(['message' => _lang('bank/cash_delete_duccessfull')]);
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
		if (!auth()->user()->can('bank.delete')) {
            abort(403, 'Unauthorized action.');
        }
		//$this->authorize('status', $this->repo->model());
		if ($request->ajax()) {
			$ids =$request->ids;
		foreach ($ids as $id) {

			$model = bank::findOrFail($id);
			if ($model->transaction()->count()) {
			throw ValidationException::withMessages(['message' => _lang($model->account_name.' '.'bank/cash_account_associate')]);
		     }
		     $model->delete();
		 }
			return $this->success(['message' => _lang('bank/cash_deleted')]);
		} else {
			return abort(404);
		}
	}
}
