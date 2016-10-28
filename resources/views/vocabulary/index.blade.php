@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">Hash</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('vocabulary') }}"  enctype="multipart/form-data">
                            
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            @if(session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
							
							<div class="col-sm-6 col-xs-12">
							     <label for="words">Words</label>
                                 <br>
								<select name="words[]" id="words" multiple="true">
                                    @foreach($words as $word )
                                        <option value="{{ $word->id }}">
                                            {{ $word->name }}
                                        </option>
                                    @endforeach
                                </select>
							</div>
                           
                           <div class="col-sm-6 col-xs-12">
                            <label for="algorithms">Algorithm types</label>
                                 <br>
                           <select name="algorithms[]" id="algorithms" multiple="true">
                               @foreach($algorithms as $algorithm)
                               <option value=" {{ $algorithm->id }}">
                                   {{ $algorithm->name }}
                               </option>
                                @endforeach
                           </select>
                               
                           </div>
                            <div class="form-group col-xs-12">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Hash
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection