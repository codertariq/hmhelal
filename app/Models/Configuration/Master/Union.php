<?php

namespace App\Models\Configuration\Master;

use Illuminate\Database\Eloquent\Model;

class Union extends Model {

	protected $fillable = ['divison_id', 'district_id', 'upozila_id', 'name', 'options'];
	protected $casts = ['options' => 'array'];
	protected $primaryKey = 'id';
	protected $table = 'unions';
	protected static $ignoreChangedAttributes = ['updated_at'];

	public function division() {
		return $this->belongsTo('App\Models\Configuration\Master\Division');
	}
	public function district() {
		return $this->belongsTo('App\Models\Configuration\Master\District');
	}
	public function upozila() {
		return $this->belongsTo('App\Models\Configuration\Master\Upozila');
	}
}
