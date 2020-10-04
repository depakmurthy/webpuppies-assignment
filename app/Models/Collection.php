<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    
    protected $table = 'save_collection';

    protected $fillable = [
        'collectionname',
    ];

    public static function getCollectionlist(){
		$value = \DB::table('save_collection')->orderBy('id', 'asc')->get();
		return $value;
	}

    public static function getCollectionCount(){
        $value = \DB::table('save_collection')->orderBy('id', 'asc')->get();
        return $value;
    }
}
