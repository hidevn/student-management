@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Answer Quiz</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {!! nl2br(e(session('status'))) !!}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (!session('status'))
                        <div class="col-md-3">Hint:</div>
                        <div class="col-md-9">{{$quiz->hint}}</div>
                        <form action="{{route('answerQuiz')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">Answer: </label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="name" name="answer" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-md-offset-5" style="margin-top:20px">
     	                        <button class="btn btn-primary" type="submit">Submit</button>
     	                    </div>
     	                    
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
