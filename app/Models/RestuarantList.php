<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestuarantList extends Model
{
    use HasFactory;

	public static function getRestuarantlist(){
		$value = \DB::table('restuarantlist')->orderBy('id', 'asc')->get();
		return $value;
	}
}
