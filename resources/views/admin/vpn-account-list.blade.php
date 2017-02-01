@extends('layouts.app')
@section('title', 'VPN Account List');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>
                <div class="panel-body">
                @if(!isset($datas))
                    {{abort(404)}}
                @else

                    <div class="table-responsive">          
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>VPN Username</th>
                            <th>VPN Server IP</th>
                            <th>VPN Create Date</th>
                            <th>VPN Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $server)
                                <tr id="row-{{$server->account_id}}">
                                    <td>{{$server->account_id}}</td>
                                    <td>{{$server->account_name}}</td>
                                    <td>{{$server->account_server}}</td>
                                    <td>{{$server->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a class="btn btn-danger btn-xs" onclick="deleteVPN('{{$server->account_id}}', '{{csrf_token()}}')"><span class="fa fa-trash"></span> Delete</a>
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
