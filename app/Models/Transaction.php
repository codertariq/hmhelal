<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $with=['chart_account','bank','payee_payer'];
	
    public function chart_account() {
		return $this->belongsTo('App\Models\ChartAccount','chart_account_id','id');
	}

	public function bank() {
		return $this->belongsTo('App\Models\Bank','bank_id','id');
	}

	public function payee_payer() {
		return $this->belongsTo('App\Models\PayeePayer','payee_payer_id','id');
	}
}
