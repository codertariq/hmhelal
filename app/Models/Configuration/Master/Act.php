<?php

namespace App\Models\Configuration\Master;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    protected $fillable = ['name','act_no', 'description', 'status'];
	protected $primaryKey = 'id';
	protected $table = 'acts';
}
