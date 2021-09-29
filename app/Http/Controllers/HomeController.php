<?php

namespace App\Http\Controllers;

use App\ExternalAPI\RingAPI;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the result of search.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $searchValue = ($request->input('search'));
        $ringAPI = New RingAPI();
        $searchResult = $ringAPI->dataByTaxNumber($searchValue);

        return view('home',compact('searchValue','searchResult'));
    }
}
