@extends('layouts.app')
@section('title', 'Server List');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>
                <div class="panel-body">
                @if(!isset($servers))
                    {{abort(404)}}
                @else
                    <div class="table-responsive">          
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Server Name</th>
                            <th>Server IP</th>
                            <th>Server Country</th>
                            <th>Server Proto</th>
                            <th>Server Create Date</th>
                            <th>Server Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($servers as $server)
                                <tr id="row-{{$server->server_id}}">
                                    <td>{{$server->server_name}}</td>
                                    <td>{{$server->server_ip}}</td>
                                    <td>{{$server->server_country}}</td>
                                    <td>{{$server->server_protocol}}</td>
                                    <td>{{$server->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a class="btn btn-danger btn-xs" onclick="deleteServer({{$server->server_id}}, '{{csrf_token()}}')"><span class="fa fa-trash"></span> Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
