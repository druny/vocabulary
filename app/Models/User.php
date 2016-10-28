<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'ip', 'browser', 'country'
    ];

     public function hashes() {
    	return $this->hasMany('App\Models\Hash');
    }
    public function algorithmes() {
    	return $this->belongsToMany('App\Models\Algorithm');
    }
    public function vocabularies() {
    	return $this->belongsToMany('App\Models\Vocabulary');
    }

    public function scopeIp($query, $ip) {
        return $query->where('ip', $ip);
    }



}
