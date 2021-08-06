<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
	protected $fillable = ['name', 'status'];


     // liên kết model
	public function news(){

		return $this->hasMany('App\Models\News');

	}
}
