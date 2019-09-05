<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseHearingDate extends Model
{
    public function case() {
		return $this->belongsTo('App\Models\Cases','case_id','id');
	}
}
