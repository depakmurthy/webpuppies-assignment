<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestuarantList;
use App\Models\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Read value from Model method
        $restuarantListData = RestuarantList::getRestuarantlist();
        $collectionCount = Collection::getCollectionCount();

        // Pass to view
        return view('home')->with("restuarantListData",$restuarantListData)->with("collectionCount",$collectionCount);
    }
}
