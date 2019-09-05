<?php

namespace App\Http\Controllers\admin\Cases;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Configuration\Category\ClientCategory;
use App\Models\Configuration\Category\CourtCategory;
use App\Models\Configuration\Category\CaseCategory;
use App\Models\Configuration\Master\Court;
use App\Models\Configuration\Master\CaseStage;
use App\Models\Configuration\Master\Act;
use App\Models\Cases;
use App\Models\CaseAct;
use App\Models\CaseHearingDate;
use App\Models\CasePayment;
use App\Models\FileCaseCategory;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class CaseHistoryController extends Controller {

  	protected $view;
  	public function __construct() {
		$this->view = 'admin.case.';
	}
	private function route() {
		return 'admin.cases.';
	}

	public function index(Request $request,$id)
	{
	if ($request->ajax()) {
	  $case =Cases::findOrFail($id);
	  return view('admin.case.archive.archived',compact('case'));
	} else {
			return abort(404);
	}
}

/**
 * Store the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */

 public function archived(Request $request)
 {
 	if ($request->ajax()) {
			$validator = $request->validate([
				'closing_date' => ['required', 'date'],
				'note' => ['sometimes', 'nullable'],
			]);
			$case = Cases::findOrFail($request->case_id);
			$case->closing_date =$request->closing_date;
			$case->note =$request->note;
			$case->close_status ="close";
			$case->save();
			return $this->success(['message' => _lang('case_archived_successfull.')]);
		}
		else {
			return abort(404);
	  }
   }

   public function postindex(Request $request)
   {
   	 return view('admin.case.archive.index');
   }

   	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function datatable(Request $request) {
		if ($request->ajax()) {
			$cases = Cases::with('client')->where('close_status','close')->get();
			return Datatables::of($cases)
				->addIndexColumn()
				->editColumn('title', function ($model) {
					return '<strong>' . $model->title . '</strong>';
				})
				->addColumn('case_no', function ($model) {
					return  $model->case_no ;
				})
				->editColumn('client', function ($model) {

					return  $model->client->name ;
				})
				->addColumn('action', function ($model) {
				$route = $this->route();
				return view($this->view.'.archive.action', compact('model', 'route'));
			})
				->rawColumns(['action','title'])->make(true);
		} else {
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
		  $case =Cases::with('client')->findOrFail($id);
		  return view($this->view.'archive.show',compact('case'));

	}

	/**
	 * Change the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function restore(Request $request,$id) {
		if ($request->ajax()) {
		    $case =Cases::findOrFail($id);
		    $case->closing_date =null;
			$case->note =null;
			$case->close_status =null;
			$case->save();
			return $this->success(['message' => _lang('case_restore_successfull.')]);
		  } else {
			return abort(404);
		}

	}
}
