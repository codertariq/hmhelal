<?php

namespace App\Models\Configuration\Master;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
	protected $fillable = ['name', 'divison_id','district_id','court_category', 'description'];
	protected $primaryKey = 'id';
	protected $table = 'courts';
	protected $with=['division','district','court_category'];
   
   public function division() {
		return $this->belongsTo('App\Models\Configuration\Master\Division');
	}

	public function district() {
		return $this->belongsTo('App\Models\Configuration\Master\District');
	}

	public function court_category() {
		return $this->belongsTo('App\Models\Configuration\Category\CourtCategory');
	}

	public function cases() {
		return $this->hasMany('App\Models\Cases');
	}
}
