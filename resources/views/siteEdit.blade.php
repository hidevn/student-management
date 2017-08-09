@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit</div>
                    
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
                        <form class="form-horizontal" method="POST" action="{{ route('siteEditUpdate') }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="id" class="col-md-3 control-label">Id </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="id" name="id" required readonly value="{{$site->id}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-md-3 control-label">Url </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="url" name="url" required value="{{$site->url}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="checkbox">
                                      <label>{{ Form::checkbox('status', 1, $site->status) }}Is Alive?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ip" class="col-md-3 control-label">IP Address </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="ip" name="ip" required value="{{$site->ip}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ports_open" class="col-md-3 control-label">Open ports </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="ports_open" name="ports_open" required value="{{$site->ports_open}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
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
