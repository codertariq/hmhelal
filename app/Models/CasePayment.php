<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CasePayment extends Model
{
    public function case() {
		return $this->belongsTo('App\Models\Cases','case_id','id');
	}
}
