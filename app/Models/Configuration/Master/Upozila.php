<?php

namespace App\Models\Configuration\Master;

use Illuminate\Database\Eloquent\Model;

class Upozila extends Model {

	protected $fillable = ['division_id', 'district_id', 'name', 'options'];
	protected $casts = ['options' => 'array'];
	protected $primaryKey = 'id';
	protected $table = 'upozilas';
	protected static $ignoreChangedAttributes = ['updated_at'];

	public function division() {
		return $this->belongsTo('App\Models\Configuration\Master\Division');
	}

	public function district() {
		return $this->belongsTo('App\Models\Configuration\Master\District');
	}

	public function unions() {
		return $this->belongsTo('App\Models\Configuration\Master\Union');
	}
}
