@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User List</div>

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
                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Type</th>
                                <th>Info</th>
                                @if (Auth::user()->is_admin == true)
                                <th>Edit</th>
                                @endif
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$user->is_admin == true?'Admin':'User'}}</td>
                                    <td><button onclick="location.href='{{route('info', ['id' => $user->id ])}}';" class="btn btn-default"><i class="fa fa-info"></i></button></td>
                                    @if (Auth::user()->is_admin == true)
                                    <td><button onclick="location.href='{{route('edit', ['id' => $user->id ])}}';" class="btn btn-default"><i class="fa fa-edit"></i></button></td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
