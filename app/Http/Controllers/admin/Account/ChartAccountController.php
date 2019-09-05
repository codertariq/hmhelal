<?php

namespace App\Http\Controllers\admin\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ChartAccount;
use Validator;
use Illuminate\Validation\Rule;
use Auth;

class ChartAccountController extends Controller
{
    protected $view;
  	public function __construct() {
		$this->view = 'admin.transaction.chart_account.';
	}
	private function route() {
		return 'admin.transaction.chart-account.';
	}

	public function index()
	{
	 if (!auth()->user()->can('chartAccount.view')) {
            abort(403, 'Unauthorized action.');
        }
	  return view($this->view . 'index');
	}

		/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function datatable(Request $request) {
		 if (!auth()->user()->can('chartAccount.view')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$ca = ChartAccount::all()->sortByDesc("id");
			return Datatables::of($ca)
				->addIndexColumn()
				->editColumn('name', function ($model) {
					return '<strong>' . $model->name . '</strong>';
				})
				->addColumn('type', function ($model) {
					return  $model->type ;
				})
				->addColumn('action', function ($model) {
				$route = $this->route();
				return view($this->view.'action', compact('model', 'route'));
			})
				->rawColumns(['action','name'])->make(true);
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
		if (!auth()->user()->can('chartAccount.create')) {
            abort(403, 'Unauthorized action.');
        }
		if (!$request->ajax()) {
			return abort(404);
		}  
		return view($this->view.'form');
	}

	/**
	 * Store the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request) {
		 if (!auth()->user()->can('chartAccount.create')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$validator = $request->validate([
				'name' => ['required', 'max:255'],
				'type' => ['required'],
			]);

			$ca =new ChartAccount;
			$ca->name =$request->name;
			$ca->type =$request->type;
			$ca->save();
			return $this->success(['message' => _lang('chart_account_add_successfully.')]);
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
		if (!auth()->user()->can('chartAccount.update')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$model = ChartAccount::findOrFail($id);
			return view($this->view.'form', compact('model'));
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
		 if (!auth()->user()->can('chartAccount.update')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$validator = $request->validate([
				'name' => ['required', 'max:255'],
				'type' => ['required'],
			]);
		    $ca =ChartAccount::findOrFail($id);
			$ca->name =$request->name;
			$ca->type =$request->type;
			$ca->save();
			return $this->success(['message' => _lang('ChartAccount_update_successfully.')]);
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
		if (!auth()->user()->can('chartAccount.view')) {
            abort(403, 'Unauthorized action.');
        }
      if ($request->ajax()) {
       $model =ChartAccount::with('transaction')->findOrFail($id);
       return view($this->view . 'show',compact('model'));

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
		if (!auth()->user()->can('chartAccount.delete')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$model = ChartAccount::findOrFail($id);
			if ($model->transaction()->count()) {
			throw ValidationException::withMessages(['message' => _lang($model->name.' '.'associate_with_transaction')]);
		     }
			$model->delete();
			return $this->success(['message' => _lang('ChartAccount_delete_successfull')]);
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
		 if (!auth()->user()->can('chartAccount.delete')) {
            abort(403, 'Unauthorized action.');
        }
		//$this->authorize('status', $this->repo->model());
		if ($request->ajax()) {
			$ids =$request->ids;
		foreach ($ids as $id) {
			$model = ChartAccount::findOrFail($id);
			if ($model->transaction()->count()) {
			throw ValidationException::withMessages(['message' => _lang($model->name.' '.'associate_with_transaction')]);
		     }
		     $model->delete();
		}
			return $this->success(['message' => _lang('ChartAccount_delete_successfull')]);
		} else {
			return abort(404);
		}
	}

}
