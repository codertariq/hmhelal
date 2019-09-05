<?php

namespace App\Models\Configuration\Category;

use Illuminate\Database\Eloquent\Model;

class CaseCategory extends Model {
	protected $fillable = ['name', 'description', 'status'];
	protected $primaryKey = 'id';
	protected $table = 'case_categories';
	
	public function cases() {
		return $this->hasMany('App\Models\Cases');
	}
}
