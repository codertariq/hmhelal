<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseAct extends Model
{
  protected $with=['actname'];
  public function actname() {
		return $this->belongsTo('App\Models\Configuration\Master\Act','act_id','id');
	}
}
