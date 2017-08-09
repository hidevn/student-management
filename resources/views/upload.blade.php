@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Exercises</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        <form action="{{route('uploadExercise')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">Exercise Name: </label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="col-md-12" style="margin-top:20px">
                                    <input class="form-control" type="file" name="file" />
                                </div>
                            </div>
                            <div class="col-md-12 col-md-offset-5" style="margin-top:20px">
     	                        <button class="btn btn-primary" type="submit">Upload</button>
     	                    </div>
     	                    
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
