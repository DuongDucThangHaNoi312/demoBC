<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
	protected $table = 'post_models'; 
	protected $primaryKey = 'post_id'; 
	protected $fillable = ['name', 'slug', 'description' ];
	protected $dates = ['deleted_at']; 

    // dateFilter
	public function scopeDateFilter( $query, $from_date=null, $to_date=null ){

		if( !empty( $from_date ) ){
			$from_date = date('Y-m-d 00:00:01', strtotime( $from_date ) );

			$to_date = ( !empty( $to_date ) )? date('Y-m-d 23:59:59', strtotime( $to_date ) ) : date('Y-m-d 23:59:59' );

			$query->whereBetween( 'created_at', [ $from_date, $to_date ] );
		}

		return $query;
	}
}
