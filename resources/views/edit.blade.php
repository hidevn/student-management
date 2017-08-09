@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit information</div>
                    
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
                        <form class="form-horizontal" method="POST" action="{{ route('editPost') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="id" class="col-md-3 control-label">Id </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="id" name="id" required readonly value="{{$user->id}}">
                                </div>
                            </div>
                            @if (Auth::user()->is_admin)
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label">Name </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="name" name="name" required value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-md-3 control-label">Username </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="username" name="username" required value="{{$user->username}}">
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">Email </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="email" id="email" name="email" required value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-md-3 control-label">Phone Number </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="phone" name="phone" required value="{{$user->phone_number}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="checkbox">
                                      <label><input type="checkbox" id="pw-check" value="">Change password?</label>
                                    </div>
                                </div>
                            </div>
                            <div id="pw-dialog" style="display: none">
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">New password </label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="password" id="password" name="password" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password-again" class="col-md-3 control-label">Retype password </label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" value="" disabled>
                                    </div>
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
    <script>
        $(document).ready(function(){
            $('#pw-check').change(function(){
                if (this.checked){
                    $('#pw-dialog').show();
                    $('#password').prop('disabled', false);
                    $('#password').prop('required', true);
                    $('#password_confirmation').prop('disabled', false);
                    $('#password_confirmation').prop('required', true);
                }
                else {
                    $('#pw-dialog').hide();
                    $('#password').prop('disabled', true);
                    $('#password').prop('required', false);
                    $('#password_confirmation').prop('disabled', true);
                    $('#password_confirmation').prop('required', false);
                }
            })
        })
    </script>
@endsection
