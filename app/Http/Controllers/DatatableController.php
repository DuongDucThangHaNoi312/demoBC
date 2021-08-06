<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;

class DatatableController extends Controller
{
	public function index( Request $request ){
		$info = [];
		return view( 'datatables.list', $info );
	}

	public function posts( Request $request ){

		$info = [
			'draw' => $request->draw,
			'data' => [],
			'total' => 0,
		];

		$search = $request->input('search.value');

		$posts = PostModel::orWhere( function($query) use ( $search ) {
			$query->where( "name", "LIKE", "%".$search."%" )->where( "slug", "LIKE", "%".$search."%" );
		} )->dateFilter( $request->from_date, $request->to_date )->take( $request->length )->skip( $request->start )->get();

		$info['total'] = PostModel::orWhere( function($query) use ( $search ) {
			$query->where( "name", "LIKE", "%".$search."%" )->where( "slug", "LIKE", "%".$search."%" );
		} )->dateFilter( $request->from_date, $request->to_date )->count();

		$sl_no_counter = ( $request->start == 0 )? 1 : $request->start+1;

		foreach( $posts as $post ){
			$post->sl_no = $sl_no_counter;
			$sl_no_counter++;
		}

		$info['data'] = $posts;

		return $info;
	}
}
