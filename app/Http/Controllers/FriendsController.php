<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Friends;
use Auth;
use Mail;

class FriendsController extends Controller
{
	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
    public function index()
    {
        $collectionCount = Collection::getCollectionCount();
        $friendsListCount = Friends::getFriendsList();
        $checkFriends = Friends::checkFriends();
        $currentuseremail = Auth::user()->email;
        $currentuserusername = Auth::user()->name;
        
        foreach ($checkFriends as $key => $value) {
            if ($currentuseremail === $value->femail) {
                return view('friends')->with("collectionCount",$collectionCount)->with("friendsListCount",$friendsListCount);
            } else {
                if ($currentuserusername === $value->username) {
                    return view('friends')->with("collectionCount",$collectionCount)->with("friendsListCount",$friendsListCount);
                } else {
                    $friendsListCount = array();
                    return view('friendsnew')->with("collectionCount",$collectionCount)->with("friendsListCount",$friendsListCount);
                }
            }
        }
        
        
    }

    public function inviteFriends() {

    	$currentuseridorname = Auth::user()->name;
    	$find = \DB::table('friends')->where('femail',$_POST["emailvalue"])->first();

    	if ($find === NULL) {            

    		$task = new Friends;
			$task->username = $currentuseridorname;
			$task->femail = $_POST["emailvalue"];
			$task->status = "0";
			$task->save();

            /*$data = array('name'=>"Deepak Murthy");

            Mail::send(['text'=>'mail'], $data, function($message) {
                $message->to($_POST["emailvalue"], 'Friend Request')->subject
                ('Friend Request Invitation to Edit Collections');
                $message->from('deepakmurthy.888@gmail.com','Deepak Murthy');
            });*/
            
			return "success";
    	} else {
			return "fail";
    	}

    }
}
