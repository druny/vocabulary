<?php


namespace App\Helpers;



use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Models\Hash as HashModel;
use App\Models\User;

class HashHelper
{

	

    public static function hash( $request, $words, $algorithms)
    {
    	
        foreach ($algorithms as $algorithm) {

        	//Check what algorithm type select user, and use needed method
        	$methodName = $algorithm->name . 'Hash';

        	foreach($words as $word) {
        		//Passes on to every word on needed method
				$hashWord =  self::$methodName($word);
				
				self::store($request, $algorithm->id, $word->id, $hashWord);
				
        	}
        	
        }    
    	
    }

    public static function store($request, $algorithm_id, $word_id, $hashWord) {

    	//The task hasn't been accurately put and I have decided that there is no sense to do special division into users

    	$user = User::ip($request->ip())->first();

    	$hash = new HashModel();
		$hash->fill([
			'user_id' => $user->id,
			'algorithm_id' => $algorithm_id,
			'vocabulary_id' => $word_id,
			'hash' => $hashWord,
		]);
		$hash->save();
    }

    public static function md5Hash($word) {
    	return  md5(time() . $word->name);
    }

    public static function sha1Hash($word) {
    	return sha1($word->name);
    }

    public static function cryptHash($word) {
    	
    	return crypt($word->name, str_random(25));
    }

    public static function crc32Hash($word) {
    	return crc32($word->name);
    }

    public static function laravelHash($word) {
    	return Hash::make($word->name);
    }
}