@extends('layouts.app')

@section('content')




    <div class="container-fluide col-xs-12">
        <div class="row">
            <div class="col-xs-12 ">
                <div class="panel panel-danger">
                    <div class="panel-heading">History</div>

                    <div class="panel-body">
                    
                    <table>
                        <tr>
                            <td>
                                <p>Твой id: {{ $user->id }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Твой ip: {{ $user->ip }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Браузер: {{ $user->browser }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Страна: {{ $user->country }}</p>
                            </td>
                        </tr>
                    </table>
                    <div class="table-responsive">
                
                        <table class="table">
                            <tr>
                                 <th>
                                     Original word
                                </th>
                                <th>
                                    Hashed
                                </th>
                                <th>
                                    Algorithm
                                </th>
                                <th>
                                    Time
                                </th>
                            </tr>
                            @foreach($words as $word)
                            <tr>
                                
                                    <td>
                                        <p>
                                            {{ $word->word_name }}
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            {{ $word->hash }}
                                        </p>
                                    </td>
                                    <td>
                                        {{ $word->algorithmes_name }}
                                    </td>
                                    <td>
                                        {{ $word->created_at }}
                                    </td>
                                
                            </tr>
                            @endforeach
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection