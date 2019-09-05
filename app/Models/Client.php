<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'divison_id','district_id','mobile', 'email','gender','address','file','status'];
	protected $primaryKey = 'id';
	protected $table = 'clients';
	protected $with=['division','district','case'];
   
   public function division() {
		return $this->belongsTo('App\Models\Configuration\Master\Division');
	}

	public function district() {
		return $this->belongsTo('App\Models\Configuration\Master\District');
	}

	public function case() {
		return $this->hasMany('App\Models\Cases','client_id','id');
	}
}
