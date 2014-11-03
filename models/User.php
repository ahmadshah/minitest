<?php /** Sample model */
use Illuminate\Database\Eloquent\Model;

class User extends Model {

	public function scopePaginates($query, $perPage, $page = 1) 
	{
		$offset = ($page - 1) * $perPage;
		return $query->skip($offset)->take($perPage);
	}

}