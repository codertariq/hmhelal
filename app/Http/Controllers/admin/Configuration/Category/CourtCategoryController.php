<?php

namespace App\Http\Controllers\admin\Configuration\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuration\Category\CourtCategoryRequest;
use App\Repositories\Configuration\Category\CourtCategoryRepository;
use Illuminate\Http\Request;

class CourtCategoryController extends Controller {

	protected $request;
	protected $repo;
	protected $view;
	protected $lang;

	public function __construct(
		Request $request,
		CourtCategoryRepository $repo
	) {
		$this->request = $request;
		$this->repo = $repo;
		$this->view = 'configuration.category.court.';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (!auth()->user()->can('court_category.view')) {
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
		if (!auth()->user()->can('court_category.view')) {
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
		if (!auth()->user()->can('court_category.create')) {
			abort(403, 'Unauthorized action.');
		}
		if (!$this->request->ajax()) {
			return abort(404);
		}

		if ($this->request->form_id) {
			$data['name'] = $this->request->name;
			$data['form_id'] = $this->request->form_id;
			return view($this->view . 'form_select', compact('data'));
		}

		return view($this->view . 'form');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CourtCategoryRequest $request) {

		if (!auth()->user()->can('court_category.create')) {
			abort(403, 'Unauthorized action.');
		}
		if ($this->request->ajax()) {
			$model = $this->repo->create($this->request->all());
			return $this->success(['message' => _lang('Court Category Added Successfull.'), 'model' => $model]);
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
		if (!auth()->user()->can('court_category.view')) {
			abort(403, 'Unauthorized action.');
		}
		if ($this->request->ajax()) {
			$model = $this->repo->getQuery()->with('cases')->findOrFail($id);
			return view($this->view . 'show', compact('model'));
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
	public function edit($id) {
		if (!auth()->user()->can('court_category.update')) {
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
	public function update(CourtCategoryRequest $request, $id) {
		if (!auth()->user()->can('court_category.update')) {
			abort(403, 'Unauthorized action.');
		}
		if ($this->request->ajax()) {
			$model = $this->repo->findOrFail($id);
			$this->repo->update($model, $this->request->all());
			return $this->success(['message' => _lang('Court Category Updated Successfull.')]);
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
		if (!auth()->user()->can('court_category.delete')) {
			abort(403, 'Unauthorized action.');
		}
		if ($this->request->ajax()) {
			$this->repo->deletable($id);
			$model = $this->repo->findOrFail($id);
			$this->repo->delete($model, $this->request->all());
			return $this->success(['message' => _lang('Court Category Deleted Successfull')]);
		} else {
			return abort(404);
		}
	}

	/**
	 * Change Status the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function status($id) {
		if (!auth()->user()->can('court_category.update')) {
			abort(403, 'Unauthorized action.');
		}
		//$this->authorize('status', $this->repo->model());
		if ($this->request->ajax()) {
			$model = $this->repo->findOrFail($id);
			$this->repo->updateStatus($model, $id);
			return $this->success(['message' => trans('status_change')]);
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
		if (!auth()->user()->can(['court_category.update', 'court_category.delete'])) {
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
