<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileCaseCategory extends Model
{
  protected $with=['category'];
   public function category() {
		return $this->belongsTo('App\Models\Configuration\Category\CaseCategory','case_category_id','id');
	}
}
