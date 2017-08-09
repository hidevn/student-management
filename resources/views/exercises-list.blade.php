@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Exercises List</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if(count($exercises) != 0)
                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th class="col-md-8">Title</th>
                            <th style="text-align:center">Upload</th>
                            <th style="text-align:center">Download</th>
                            @if (Auth::user()->is_admin == true)
                            <th style="text-align:center">Delete</th>
                            <th style="text-align:center">Solutions</th>
                            @endif
                        </tr>
                        @foreach($exercises as $exercise)
                        <tr>
                            <td>{{$exercise->id}}</td>
                            <td>{{$exercise->title}}</td>
                            <td style="text-align:center"><button data-toggle="modal" data-target="#upload-{{$exercise->id}}" class="btn btn-default"><i class="fa fa-upload"></i></button></td>
                            <td style="text-align:center"><button onclick="location.href='{{route('downloadExercise', ['id' => $exercise->id ])}}';" class="btn btn-default"><i class="fa fa-download"></i></button></td>
                            @if (Auth::user()->is_admin == true)
                            <td>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['deleteExercise', $exercise->id]]) }}
                                <button class="btn btn-default"  style="text-align:center"><i class="fa fa-trash"></i></button> {{ Form::close() }}
                                <td style="text-align:center"><button class="btn btn-default" data-toggle="modal" data-target="#exercise-{{$exercise->id}}"><i class="fa fa-info"></i></button></td>
                            </td>
                            @endif
                            <div id="upload-{{$exercise->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Upload Homework</h4>
                                        </div>

                                        <div class="modal-body">
                                            <form id="form-{{$exercise->id}}" class="form-horizontal stupid-form" method="POST" enctype="multipart/form-data" action="{{ route('uploadSolution', ['id' => $exercise->id ])}}">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <input form="form-{{$exercise->id}}" type="submit" class="btn btn-primary"></button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="exercise-{{$exercise->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Homework Uploaded</h4>
                                        </div>

                                        <div class="modal-body">
                                            @if(count($exercise->solutions) == 0)
                                            <div>There's no solution uploaded.</div>
                                            @else
                                                @foreach($exercise->solutions as $solution)
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-3">{{$solution->user->name}}</div>
                                                                <div class="col-md-7">{{$solution->note}}</div>
                                                                <div class="col-md-1">
                                                                    <button onclick="location.href='{{route('downloadSolution', ['id' => $solution->id ])}}';" class="btn btn-default"><i class="fa fa-download"></i></button>
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
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <div class="col-md-12">There's no exercise.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.stupid-form').append('{{ csrf_field() }}' +
        '<div class="form-group" style="min-height:80px">' + 
        '<label for="note" class="col-md-3">Note</label>'+
        '<div class="col-md-9">'+
        '<input class="form-control input-sm" id="note" name="note" type="text">'+
        '</div>'+
        '<div class="col-md-12" style="margin-top:20px">'+
        '<input class="form-control" type="file" name="file" />'+
        '</div>'+
        '</div>')
    });
</script>
@endsection
