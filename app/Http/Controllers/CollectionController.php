<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use Auth;
use DataTables;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Collection::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->resid.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->resid.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('col');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Collection::updateOrCreate(['resid' => $request->product_id],
                ['collectionname' => $request->name]);
   
        return response()->json(['success'=>'Collection saved successfully.']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        $collections = Collection::find($id);
        $collectionCount = Collection::getCollectionCount();

        return view('collections.show')->with('collections', $collections)->with("collectionCount",$collectionCount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Collection::find($id);
        return response()->json($collection);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $collections = Collection::where('resid',$id)->first();
        //var_dump($collections); exit();
        $collections->delete();
     
        return response()->json(['success'=>'Collection deleted successfully.']);
    }

    public function myCollection() {

        $collectionListData = Collection::getCollectionlist();
        $collectionCount = Collection::getCollectionCount();
        foreach ($collectionListData as $key => $value) {
            $resname = \DB::table('restuarantlist')->where('id', $value->resid)->first();
            $result[] = array("resid" => $resname->resname, "uname" => $value->uname, "collectionname" => $value->collectionname, "id" => $value->resid);
        }

        return view('col')->with("result",$result)->with("collectionCount",$collectionCount);
    }

    public function saveCollection()
    {
    	$currentuseridorname = Auth::user()->name;

        $find = \DB::table('save_collection')->where(
            [
                'collectionname' => $_POST["cname"],
                'resid' => $_POST["id"]            
            ]
            )->first();
        if ($find === NULL) {
            $task = new Collection;
            $task->uname = $currentuseridorname;
            $task->collectionname = $_POST["cname"];
            $task->resid = $_POST["id"];
            $task->save();

            return "success";
        } else {
            return "fail";
        }	
		
    }
}
