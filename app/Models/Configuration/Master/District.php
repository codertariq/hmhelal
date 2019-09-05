<?php

namespace App\Models\Configuration\Master;

use Illuminate\Database\Eloquent\Model;

class District extends Model {

	protected $fillable = ['division_id', 'name', 'options'];
	protected $casts = ['options' => 'array'];
	protected $primaryKey = 'id';
	protected $table = 'districts';
	protected static $ignoreChangedAttributes = ['updated_at'];

	public function division() {
		return $this->belongsTo('App\Models\Configuration\Master\Division', 'division_id', 'id');
	}

	public function upozilas() {
		return $this->hasMany('App\Models\Configuration\Master\Upozila');
	}
}
