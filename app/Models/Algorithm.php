<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Algorithm extends Model
{
	protected $table = 'algorithmes';
    protected $fillable = ['name'];

    public function hashes() {
		return $this->hasMany('App\Models\Hash');
    }
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function scopeId($query, $id) {
    	return $query->where('id', $id);
    }
}
