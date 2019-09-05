<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayeePayer extends Model
{
    public function transaction() {
		return $this->hasMany('App\Models\Transaction');
	}
}
