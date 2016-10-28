<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hash extends Model
{
	protected $table = 'hashes';

    protected $fillable = ['user_id', 'algorithm_id', 'vocabulary_id', 'hash'];

    public function algorithmes() {
    	return $this->belongsTo('App\Models\Algorithm');
    }
    public function vocabularies() {
    	return $this->hasMany('App\Models\Vocabulary');
    }

    public function users() {

    	return $this->hasMany('App\Models\User');
    }

    public function scopeId($query, $id) {
    	return $query->where('user_id', $id);
    }

    public function getHash($user_id) {

    	return DB::table($this->table)
    		->join('algorithmes', 'algorithmes.id', '=', 'hashes.algorithm_id')
    		->join('vocabularies', 'vocabularies.id', '=', 'hashes.vocabulary_id')
    		->select('hashes.hash', 'hashes.created_at', 'algorithmes.name as algorithmes_name', 'vocabularies.name as word_name')
    		->where('hashes.user_id', $user_id)
    		->get();
    }

}
