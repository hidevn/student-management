@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User information</div>

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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-3">Id</div>
                        <div class="col-md-9">{{$user->id}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Name</div>
                        <div class="col-md-9">{{$user->name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Username</div>
                        <div class="col-md-9">{{$user->username}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Email</div>
                        <div class="col-md-9">{{$user->email}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Phone Number</div>
                        <div class="col-md-9">{{$user->phone_number}}</div>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#list-messages">Messages Sent</button>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new-message">Send New Message</button>
                    <!-- Modal -->
                    <div id="list-messages" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Messages Sent</h4>
                                </div>
                                <div class="modal-body">
                                    @if(count($messages) == 0)
                                    <div>There's no message now.</div>
                                    @else
                                        @foreach($messages as $message)
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-10">{{$message->content}}</div>
                                                        <div class="col-md-1">
                                                            <button data-toggle="modal" data-target="#edit-message-{{$message->id}}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>
                                                        </div>
                                                        <div class="col-md-1">
                                                            {{ Form::open(['method' => 'DELETE', 'route' => ['deleteMessage', $message->id]]) }}
                                                                <button class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="edit-message-{{$message->id}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                            
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Edit Message</h4>
                                                            </div>
                                                            {{ Form::open(['method' => 'PUT', 'route' => ['updateMessage', $message->id]]) }}
                                                            <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="content">Message:</label>
                                                                        <input class="form-control input-sm" id="content" name="content" type="text" required value="{{$message->content}}">
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                            </form>
                                                        </div>
                            
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="new-message" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">New Message</h4>
                                </div>
                                <form method="POST" action="{{ route('sendMessage', ['id' => $user->id]) }}">
                                    {{ csrf_field() }}
                                <div class="modal-body">
                                        <div class="form-group">
                                            <label for="content">Message:</label>
                                            <input class="form-control input-sm" id="content" name="content" type="text" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection