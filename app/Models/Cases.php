<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Cases extends Model
{
	use SearchableTrait;
		protected $searchable = [
		/**
		 * Columns and their priority in search results.
		 * Columns with higher values are more important.
		 * Columns with equal values have equal importance.
		 *
		 * @var array
		 */
		'columns' => [
			'cases.case_no' => 10,
			'cases.thana' => 9,
			'cases.title' => 9,
			'clients.name'=>7,
			'client_categories.name'=>4,
			'case_stages.name'=>2,
			'courts.name'=>5,
			'case_hearing_dates.date'=>9,
		],
		 'joins' => [
            'clients' => ['clients.id','cases.client_id'],

            'client_categories' => ['client_categories.id','cases.client_category_id'],

            'case_stages' => ['case_stages.id','cases.case_stage_id'],

            'courts' => ['courts.id','cases.court_id'],

            'case_hearing_dates' => ['cases.id','case_hearing_dates.case_id'],
        ],
	];
  protected $fillable = ['title', 'case_no','client_id','client_category_id', 'case_stage_id','filling_date','first_hearing_date','opposite_lawyer','fees','thana','denemee','room_no','file_no'];
	protected $primaryKey = 'id';
	protected $table = 'cases';
	protected $with=['court','case_categories','case_act','client_category','hearing','case_payment','case_study'];

   public function client() {
		return $this->belongsTo('App\Models\Client');
	}

	public function court() {
		return $this->belongsTo('App\Models\Configuration\Master\Court');
	}

   public function client_category() {
		return $this->belongsTo('App\Models\Configuration\Category\ClientCategory');
	}
	public function case_stage() {
		return $this->belongsTo('App\Models\Configuration\Master\CaseStage');
	}

	public function case_categories() {
		return $this->hasMany('App\Models\FileCaseCategory','case_id','id');
	}

	public function hearing() {
		return $this->hasMany('App\Models\CaseHearingDate','case_id','id')->orderBy('date','desc');
	}

	public function case_act() {
		return $this->hasMany('App\Models\CaseAct','case_id','id');
	}
	public function case_payment() {
		return $this->hasMany('App\Models\CasePayment','case_id','id');
	}
	public function case_study() {
		return $this->hasMany('App\Models\CaseStudy','case_id','id');
	}
}
