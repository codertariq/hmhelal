<?php

namespace App\Http\Controllers\admin\Configuration\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuration\Master\DivisionRequest;
use App\Repositories\Configuration\Master\DivisionRepository;
use Illuminate\Http\Request;

class DivisionController extends Controller {

	protected $request;
	protected $repo;
	protected $view;
	protected $lang;

	public function __construct(
		Request $request,
		DivisionRepository $repo
	) {
		$this->request = $request;
		$this->repo = $repo;
		$this->view = 'configuration.master.division.';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (!auth()->user()->can('location.view')) {
            abort(403, 'Unauthorized action.');
        }
		return view($this->view . 'index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function datatable() {
		if (!auth()->user()->can('location.view')) {
            abort(403, 'Unauthorized action.');
        }
		if ($this->request->ajax()) {
			return $this->repo->datatable();
		} else {
			return abort(404);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (!auth()->user()->can('location.create')) {
            abort(403, 'Unauthorized action.');
        }
		// $this->authorize('create', $this->repo->model());
		if (!$this->request->ajax()) {
			return abort(404);
		}
		if ($this->request->form_id) {
			return view($this->view . 'form_select', $this->repo->preReuisiteSelectForm($this->request));
		}

		return view($this->view . 'form');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(DivisionRequest $request) {
		if (!auth()->user()->can('location.create')) {
            abort(403, 'Unauthorized action.');
        }
		if ($this->request->ajax()) {
			$model = $this->repo->create($this->request->all());
			return $this->success(['message' => _lang('Division Added Successfull.'), 'model' => $model]);
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		if (!auth()->user()->can('location.update')) {
            abort(403, 'Unauthorized action.');
        }
		if ($this->request->ajax()) {
			$model = $this->repo->findOrFail($id);
			return view($this->view . 'form', compact('model'));
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
	public function update(DivisionRequest $request, $id) {
		if (!auth()->user()->can('location.update')) {
            abort(403, 'Unauthorized action.');
        }
		if ($this->request->ajax()) {
			$model = $this->repo->findOrFail($id);
			$this->repo->update($model, $this->request->all());
			return $this->success(['message' => _lang('Division Updated Successfull.')]);
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
	public function destroy($id) {
		if (!auth()->user()->can('location.delete')) {
            abort(403, 'Unauthorized action.');
        }
		if ($this->request->ajax()) {
			$this->repo->deletable($id);
			$model = $this->repo->findOrFail($id);
			$this->repo->delete($model, $this->request->all());
			return $this->success(['message' => _lang('Division Deleted Successfull')]);
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
	public function action() {
		if (!auth()->user()->can('location.delete')) {
            abort(403, 'Unauthorized action.');
        }
		//$this->authorize('status', $this->repo->model());
		if ($this->request->ajax()) {
			$action = $this->repo->actions($this->request->all());
			return $this->success(['message' => _lang($action)]);
		} else {
			return abort(404);
		}
	}
}
