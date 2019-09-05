<?php

namespace App\Models\Configuration\Category;

use Illuminate\Database\Eloquent\Model;

class CourtCategory extends Model {
	protected $fillable = ['name', 'description', 'status'];
	protected $primaryKey = 'id';
	protected $table = 'court_categories';

	public function cases() {
		return $this->hasMany('App\Models\Cases');
	}
}
