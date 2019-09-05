<?php

namespace App\Http\Controllers\admin\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PayeePayer;
use Validator;
use Illuminate\Validation\Rule;
use Auth;

class PayeePayerController extends Controller
{
    protected $view;
  	public function __construct() {
		$this->view = 'admin.transaction.payee_payer.';
	}
	private function route() {
		return 'admin.transaction.payee-payers.';
	}

	public function index()
	{
	 if (!auth()->user()->can('payePayer.view')) {
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

		if (!auth()->user()->can('payePayer.view')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$pp = PayeePayer::all()->sortByDesc("id");
			return Datatables::of($pp)
				->addIndexColumn()
				->editColumn('name', function ($model) {
					return '<strong>' . $model->name . '</strong>';
				})
				->addColumn('type', function ($model) {
					return  $model->type ;
				})
				->editColumn('note', function ($model) {

					return  $model->note ;
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

		if (!auth()->user()->can('payePayer.create')) {
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
		if (!auth()->user()->can('payePayer.create')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$validator = $request->validate([
				'name' => ['required', 'max:255'],
				'type' => ['required'],
			]);

			$pp =new PayeePayer;
			$pp->name =$request->name;
			$pp->type =$request->type;
			$pp->note =$request->note;
			$pp->save();
			return $this->success(['message' => _lang('payee/payer_add_successfully.')]);
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
		if (!auth()->user()->can('payePayer.update')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$model = PayeePayer::findOrFail($id);
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
		if (!auth()->user()->can('payePayer.update')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$validator = $request->validate([
				'name' => ['required', 'max:255'],
				'type' => ['required'],
			]);
		    $pp =PayeePayer::findOrFail($id);
			$pp->name =$request->name;
			$pp->type =$request->type;
			$pp->note =$request->note;
			$pp->save();
			return $this->success(['message' => _lang('payee/payer_update_successfully.')]);
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
		if (!auth()->user()->can('payePayer.view')) {
            abort(403, 'Unauthorized action.');
        }
	   if ($request->ajax()) {
       $model =PayeePayer::with('transaction')->findOrFail($id);
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
		if (!auth()->user()->can('payePayer.delete')) {
            abort(403, 'Unauthorized action.');
        }
		if ($request->ajax()) {
			$model = PayeePayer::findOrFail($id);
			if ($model->transaction()->count()) {
			throw ValidationException::withMessages(['message' => _lang($model->name.' '.'associate with transaction')]);
		     }
			$model->delete();
			return $this->success(['message' => _lang(' delete_successfull')]);
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
		if (!auth()->user()->can('payePayer.delete')) {
            abort(403, 'Unauthorized action.');
        }
		//$this->authorize('status', $this->repo->model());
		if ($request->ajax()) {
			$ids =$request->ids;
		foreach ($ids as $id) {

			$model = PayeePayer::findOrFail($id);
			if ($model->transaction()->count()) {
			throw ValidationException::withMessages(['message' => _lang($model->name.' '.'associates_with_transaction')]);
		     }
		     $model->delete();
		}
			return $this->success(['message' => _lang(' delete_uccessfull')]);
		} else {
			return abort(404);
		}
	}


}
