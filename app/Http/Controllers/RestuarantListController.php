<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestuarantList;
use DataTables;
use DB;

class RestuarantListController extends Controller
{
    public function index(Request $request) {
		if(request()->ajax()) {
			if($request->category) {
				$data = DB::table('restuarantlist')
				->join('category', 'category.category_id', '=', 'restuarantlist.openorclose')
				->select('restuarantlist.resname', 'restuarantlist.rating', 'restuarantlist.visits', 'restuarantlist.date', 'category.category_name')
				->where('restuarantlist.openorclose', $request->category);
			} else {
				$data = DB::table('restuarantlist')
				->join('category', 'category.category_id', '=', 'restuarantlist.openorclose')
				->select('restuarantlist.resname', 'restuarantlist.rating', 'restuarantlist.visits', 'restuarantlist.date', 'category.category_name');
			}
			return datatables()->of($data)->make(true);
		}

		$category = DB::table('category')
		->select("*")
		->get();

		return view('column_searching', compact('category'));
	}
}
