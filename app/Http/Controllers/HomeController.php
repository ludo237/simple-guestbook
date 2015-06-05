<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

final class HomeController extends BaseController
{
    /**
     * First endpoint for every requests
     *
     * @return \Illuminate\View\View
     */
    final public function index()
    {
        return view('index');
    }
}
