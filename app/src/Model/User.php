<?php namespace Kraken\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = 'users';

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return trim($this->getAttribute('first_name') . ' ' . $this->getAttribute('last_name'));
    }
}
