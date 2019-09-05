<?php

namespace App\Models\Configuration\Master;

use Illuminate\Database\Eloquent\Model;

class CaseStage extends Model {
	protected $fillable = ['name', 'description', 'status'];
	protected $primaryKey = 'id';
	protected $table = 'case_stages';
}
