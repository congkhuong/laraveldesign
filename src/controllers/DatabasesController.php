<?php namespace Congkhuong\LaravelDesign\Controllers;
use App\Http\Controllers\Controller;

class DatabasesController extends Controller {

	public function index()
	{
		exit('index');
		return view('index');
	}

	public function ajax()
	{
		return view('ajax');
	}
}