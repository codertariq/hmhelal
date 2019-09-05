<?php

namespace App\Http\Controllers\admin\Cases;

use App\Http\Controllers\Controller;
use App\Models\CaseAct;
use App\Models\CaseHearingDate;
use App\Models\CasePayment;
use App\Models\Cases;
use App\Models\CaseStudy;
use App\Models\Client;
use App\Models\Configuration\Category\CaseCategory;
use App\Models\Configuration\Category\ClientCategory;
use App\Models\Configuration\Category\CourtCategory;
use App\Models\Configuration\Master\Act;
use App\Models\Configuration\Master\CaseStage;
use App\Models\Configuration\Master\Court;
use App\Models\FileCaseCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CaseController extends Controller {

	protected $view;
	public function __construct() {
		$this->view = 'admin.case.';
	}
	private function route() {
		return 'admin.cases.';
	}

	public function index() {
		if (!auth()->user()->can('case.view')) {
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
		if (!auth()->user()->can('case.view')) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$cases = Cases::with('client')->where('close_status', null)->get();
			return Datatables::of($cases)
				->addIndexColumn()
				->editColumn('title', function ($model) {
					return '<strong>' . $model->title . '</strong>';
				})
				->addColumn('case_no', function ($model) {
					return $model->case_no;
				})
				->editColumn('client', function ($model) {

					return $model->client->name;
				})
				->addColumn('action', function ($model) {
					$route = $this->route();
					return view($this->view . 'action', compact('model', 'route'));
				})
				->rawColumns(['action', 'title'])->make(true);
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
		if (!auth()->user()->can('case.create')) {
            abort(403, 'Unauthorized action.');
        	}
		if (!$request->ajax()) {
			return abort(404);
		}

		return view($this->view . 'form', $this->preRequisite());
	}

	public function preRequisite($id = null) {
		$client = Client::all()->pluck('name', 'id')->prepend(_lang('Select One'), '');
		$client_category = ClientCategory::all()->pluck('name', 'id')->prepend(_lang('Select One'), '');
		$court_category = CourtCategory::all()->pluck('name', 'id')->prepend(_lang('Select One'), '');
		$casestage = CaseStage::all()->pluck('name', 'id')->prepend(_lang('Select One'), '');
		$casecategory = CaseCategory::all()->pluck('name', 'id');
		$act = Act::all()->pluck('name', 'id');
		$compact = compact('client', 'client_category', 'court_category', 'casestage', 'act', 'casecategory');
		if ($id) {
			$case = Cases::find($id);
			$courts = Court::where('id', $case->court_category_id)->pluck('name', 'id');
			$compact = compact('client', 'client_category', 'court_category', 'casestage', 'act', 'casecategory', 'courts');
		}
		return $compact;
	}
	/**
	 * Store the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request) {
		if (!auth()->user()->can('case.create')) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$validator = $request->validate([
				'case_no' => ['required', 'max:255'],
				'client.id' => ['required', 'integer'],
				'client_category.id' => ['required', 'integer'],
			]);
			$title = $request->title;
			if (!$title) {
				$client = Client::find($request->client['id']);
				$title = $client->name . ' v/s ' . $request->vs_name;
			}
			$case = new Cases;
			$case->title = $title;
			$case->case_no = $request->case_no;
			$case->client_id = $request->client['id'];
			$case->client_category_id = $request->client_category['id'];
			$case->case_stage_id = $request->case_stage['id'];
			$case->filling_date = $request->filling_date;
			$case->first_hearing_date = $request->first_hearing_date;
			$case->opposite_lawyer = $request->opposite_lawyer;
			$case->fees = $request->fees;
			$case->thana = $request->thana;
			$case->room_no = $request->room_no;
			$case->file_no = $request->file_no;
			$case->denemee = $request->denemee;
			$case->court_category_id = $request->court_category['id'];
			$case->court_id = $request->court['id'];
			$case->receiving_date = $request->receiving_date;
			$case->judgement_date = $request->judgement_date;
			$case->save();
			$case_id = $case->id;
			for ($i = 0; $i < count($request->act['id']); $i++) {
				$caseact = new CaseAct;
				$caseact->case_id = $case_id;
				$caseact->act_id = $request->act['id'][$i];
				$caseact->date = date('Y-m-d');
				$caseact->save();

			}
			for ($j = 0; $j < count($request->case_category['id']); $j++) {
				$filcase_category = new FileCaseCategory;
				$filcase_category->case_id = $case_id;
				$filcase_category->case_category_id = $request->case_category['id'][$j];
				$filcase_category->date = date('Y-m-d');
				$filcase_category->save();
			}

			$hearing_date = new CaseHearingDate;
			$hearing_date->case_id = $case_id;
			$hearing_date->date = $request->first_hearing_date;
			$hearing_date->save();
			return $this->success(['message' => _lang('Case Added Successfull.')]);
		} else {
			return abort(404);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, $id) {
		if (!auth()->user()->can('case.update')) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$model = Cases::findOrFail($id);
			return view($this->view . 'form', $this->preRequisite($id), compact('model'));
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
		if (!auth()->user()->can('case.update')) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$validator = $request->validate([
				'title' => ['required', 'max:255'],
				'case_no' => ['required', 'max:255'],
				'client.id' => ['required', 'integer'],
				'client_category.id' => ['required', 'integer'],
			]);
			$case = Cases::findOrFail($id);
			$case->title = $request->title;
			$case->case_no = $request->case_no;
			$case->client_id = $request->client['id'];
			$case->client_category_id = $request->client_category['id'];
			$case->case_stage_id = $request->case_stage['id'];
			$case->filling_date = $request->filling_date;
			$case->first_hearing_date = $request->first_hearing_date;
			$case->opposite_lawyer = $request->opposite_lawyer;
			$case->fees = $request->fees;
			$case->thana = $request->thana;
			$case->room_no = $request->room_no;
			$case->file_no = $request->file_no;
			$case->denemee = $request->denemee;
			$case->court_category_id = $request->court_category['id'];
			$case->court_id = $request->court['id'];
			$case->receiving_date = $request->receiving_date;
			$case->judgement_date = $request->judgement_date;
			$caseact = CaseAct::where('case_id', $id)->delete();
			$fileCase_category = FileCaseCategory::where('case_id', $id)->delete();
			if ($caseact) {
				for ($i = 0; $i < count($request->act['id']); $i++) {
					$caseact = new CaseAct;
					$caseact->case_id = $id;
					$caseact->act_id = $request->act['id'][$i];
					$caseact->date = date('Y-m-d');
					$caseact->save();

				}
				for ($j = 0; $j < count($request->case_category['id']); $j++) {
					$filcase_category = new FileCaseCategory;
					$filcase_category->case_id = $id;
					$filcase_category->case_category_id = $request->case_category['id'][$j];
					$filcase_category->date = date('Y-m-d');
					$filcase_category->save();
				}
			}
			return $this->success(['message' => _lang('Case  Updated Successfull.')]);
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
	public function show($id) {
		if (!auth()->user()->can('case.view')) {
            abort(403, 'Unauthorized action.');
        	}
		$case = Cases::with('client')->findOrFail($id);
		return view($this->view . 'show', compact('case'));

	}

	/**
	 * Store the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function hearing_date(Request $request) {
		if (!auth()->user()->can('case.view')) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$validator = $request->validate([
				'date' => ['required', 'date'],
				'note' => ['sometimes', 'nullable'],
				'file' => 'mimes:jpeg,bmp,png,jpg,gif,pdf,docx,doc|max:2000',
			]);

			$hearing_date = new CaseHearingDate;
			if ($request->hasFile('file')) {
				$storagepath = $request->file('file')->store('public/case/file');
				$fileName = basename($storagepath);
				$hearing_date->file = $fileName;
			}
			$hearing_date->case_id = $request->case_id;
			$hearing_date->date = $request->date;
			$hearing_date->note = $request->note;
			$hearing_date->save();
			return $this->success(['message' => _lang('hearing_date_added_successfull.'), 'goto' => route($this->route() . 'show', $request->case_id)]);

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
	public function preview($id) {
		if (!auth()->user()->can('case.view')) {
            abort(403, 'Unauthorized action.');
        	}

		$hearing_date = CaseHearingDate::findOrFail($id);
		return view($this->view . 'preview', compact('hearing_date'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */

	public function hear_destroy(Request $request, $id) {
		if ($request->ajax()) {
			$hearing_date = CaseHearingDate::findOrFail($id);
			if ($hearing_date->file) {
				unlink('storage/case/file/' . $hearing_date->file);
			}
			$hearing_date->delete();

			return $this->success(['message' => _lang('hearing_info_delete')]);
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
	public function invoice($id) {
		$payment = CasePayment::findOrFail($id);
		return view($this->view . 'invoice', compact('payment'));

	}

	/**
	 * Store the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function payment(Request $request) {
		if ($request->ajax()) {
			$validator = $request->validate([
				'date' => ['required', 'date'],
				'mode' => ['required', 'string'],
				'amount' => ['required', 'numeric'],
			]);

			$payment = new CasePayment;
			$payment->case_id = $request->case_id;
			$payment->date = $request->date;
			$payment->invoice_no = $request->invoice_no;
			$payment->mode = $request->mode;
			$payment->amount = $request->amount;
			$payment->save();
			$invoice_id = $payment->id;
			return $this->success(['message' => _lang('client_payment_added_successfull.'), 'window' => route($this->route() . 'invoice', $invoice_id)]);

		} else {
			return abort(404);
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function payment_destroy(Request $request, $id) {
		if ($request->ajax()) {
			$model = CasePayment::findOrFail($id);
			$model->delete();
			return $this->success(['message' => _lang('Payment Delete Successfull'), 'load' => "loadmore"]);
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
	public function case_study(Request $request) {
		if ($request->ajax()) {
			$validator = $request->validate([
				'note' => ['required'],
			]);

			$study = new CaseStudy;
			$study->case_id = $request->case_id;
			$study->note = $request->note;
			$study->save();
			return $this->success(['message' => _lang('case_study_added_successfull.'), 'goto' => route($this->route() . 'show', $request->case_id)]);

		} else {
			return abort(404);
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		if (!auth()->user()->can('case.delete')) {
            abort(403, 'Unauthorized action.');
        	}
		if ($request->ajax()) {
			$model = Cases::findOrFail($id);
			$model->delete();
			return $this->success(['message' => _lang('Case Delete Successfull')]);
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
		if (!auth()->user()->can('case.delete')) {
            abort(403, 'Unauthorized action.');
        	}
		//$this->authorize('status', $this->repo->model());
		if ($request->ajax()) {
			$ids = $request->ids;
			foreach ($ids as $id) {
				$model = Cases::findOrFail($id)->delete();
			}
			return $this->success(['message' => _lang('Case Deleted')]);
		} else {
			return abort(404);
		}
	}

}
