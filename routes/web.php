<?php


Route::get('/', ['as' => 'vocabulary', 'uses' => 'VocabularyController@index']);
Route::post('/', ['as' => 'vocabulary.hash', 'uses' => 'VocabularyController@store']);
Route::get('/history', [
	'as' => 'vocabulary.history', 
	'uses' => 'VocabularyController@history'
]);