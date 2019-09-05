<?php

namespace App\Models\Configuration\Master;

use Illuminate\Database\Eloquent\Model;

class Division extends Model {

	protected $fillable = ['sortname', 'name', 'phonecode', 'options'];
	protected $casts = ['options' => 'array'];
	protected $primaryKey = 'id';
	protected $table = 'divisions';
	protected static $ignoreChangedAttributes = ['updated_at'];

	public function districts() {
		return $this->hasMany('App\Models\Configuration\Master\District');
	}
}
