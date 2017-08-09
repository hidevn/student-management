@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">History</div>

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
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Url</th>
                                <th>Alive</th>
                                <th>IP Address</th>
                                <th>Open ports</th>
                                <th>Created By</th>
                                <th>Created Time</th>
                                <th style="text-align:center">Edit</th>
                                <th style="text-align:center">Delete</th>
                            </tr>
                            @foreach ($siteArray as $site)
                                <tr>
                                    <td>
                                        {{$site->id}}
                                    </td>
                                    <td>
                                        {{$site->url}}
                                    </td>
                                    <td>
                                        {{$site->status?'Yes':'No'}}
                                    </td>
                                    <td>
                                        {{$site->ip?$site->ip:'None'}}
                                    </td>
                                    <td>
                                        {{$site->ports_open?$site->ports_open:'None'}}
                                    </td>
                                    <td>
                                        {{$site->user->username}}
                                    </td>
                                    <td>
                                        {{$site->created_at}}
                                    </td>
                                    <td  style="text-align:center">
                                        {{ Form::open(['method' => 'get', 'route' => ['siteEdit', $site->id]]) }}
                                            <button class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        {{ Form::close() }}
                                        <!--<a href="{{route('siteEdit', ['id' => $site->id ])}}"><i class="fa fa-edit cursor"></i></a>-->
                                    </td>
                                    <td  style="text-align:center">
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['siteDelete', $site->id]]) }}
                                            <button class="btn btn-default"><i class="fa fa-trash"></i></button>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $siteArray->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
