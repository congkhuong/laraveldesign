<?php namespace Congkhuong\LaravelDesign\Controllers;

use App\Http\Controllers\Controller;

class DesignerController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        return view('laravelDesign::design');
    }
}