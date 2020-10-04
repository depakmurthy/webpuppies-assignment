<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    use HasFactory;

    protected $table = 'friends';

    protected $fillable = [
        'username',
        'femail',
        'status',
    ];

    public static function getFriendsList(){
		$value = \DB::table('friends')->orderBy('id', 'asc')->get();
		return $value;
	}

    public static function checkFriends(){
        $value = \DB::table('friends')->orderBy('id', 'asc')->get();
        return $value;
    }
}
