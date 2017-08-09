@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Setting</div>

                <div class="panel-body">
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
                    <form class="form-horizontal" method="POST" action="{{ route('settingUpdate') }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="ports" class="col-md-3 control-label">Ports </label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" id="ports" name="ports" required value="{{$portsString}}">
                            </div>
                        </div>
                        <div class="col-md-12 col-md-offset-5" style="margin-top:20px">
     	                    <button class="btn btn-primary" type="submit">Set</button>
     	                </div>
     	              </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
