<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class News extends Model
{
	protected $fillable =
	['title','status','text','newscategory_id'];

	public function newscategory() {
		return $this->belongsTo('App\Models\NewsCategory');

	}

}
