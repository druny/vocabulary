<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vocabulary;
use App\Models\Algorithm;
use App\Models\User;
use App\Models\Hash;
use App\Helpers\HashHelper;
use App\Http\Requests;

class VocabularyController extends Controller
{
    

    public function index()
    {
        $words = Vocabulary::all();
        $algorithms = Algorithm::all();

        return view('vocabulary.index', [

                'words' => $words, 
                'algorithms' => $algorithms,

            ]);
    }


    public function store(Requests\HashRequest $request)
    {
         

        if(User::ip($request->ip())->first() == NULL) {
            //Create new user
            $this->storeUser($request);

        } else {
            //if we had this user, update info
            $this->updateUser($request);
        }

        //Take words & algoritm types from db 
        //Why get id? Because user can send unknow word

        $words = [];
        foreach ($request->words as $word) {
           $words[] = Vocabulary::id($word)->firstOrFail();
        }

        $algorithms = [];

        foreach ($request->algorithms as $algorithm) {
            $algorithms[] = Algorithm::id($algorithm)->firstOrFail();
        }

        HashHelper::hash($request, $words, $algorithms);

        return redirect()->route('vocabulary.history')->with('success', 'Слова успешно хешированы');
        

    }

    public function storeUser($request) {

        //Save info about user
        //Gave info about country using geoplugin.net API
        $location = config('user.location');

        $user = new User($request->all());

        $user->ip = $request->ip();
        $user->browser = $request->header('User-Agent');
        $user->country = $location['geoplugin_countryName'];
        $user->save();

    }

    
    public function updateUser($request) {

        //If you use local server doesn't find the country
        $location = config('user.location');

        $user = User::ip($request->ip())->first();

        $user->fill([
            'browser' => $request->header('User-Agent'),
            'country' => $location['geoplugin_countryName'],
        ]);

        $user->save();
    }

    public function history(Request $request) {

        //Info about this user
        $id = User::ip($request->ip())->first()->id;

        $hashes = new Hash();
        $words = $hashes->getHash($id);
        $user = User::ip($request->ip())->first();

        return view('vocabulary.history', [

            'user' => $user,

            'words' => $words,
        ]);
    }
}
