<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserssController extends Controller
{

	public function __construct()
	{
		$this->middleware([
			// 'role:user|superadministrator',
		]);
	}

	public function index()
	{
		return view('user.home');
	}
}
