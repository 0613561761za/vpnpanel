@extends('layouts.app')
@section('title', 'List SSH Account')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>

                <div class="panel-body">
                    @if($sshs->count() < 1)
                        <h2 style="text-align: center;">NO SSH ACCOUNT FOUND.</h2>
                    @else
                        <div class="table-responsive">          
                          <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>SSH Username</th>
                                <th>SSH Server IP</th>
                                <th>SSH Create Date</th>
                                <th>SSH Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($sshs as $ssh)
                                    <tr id="row-{{$ssh->account_id}}">
                                        <td>{{$ssh->account_id}}</td>
                                        <td>{{$ssh->account_name}}</td>
                                        <td>{{$ssh->account_server}}</td>
                                        <td>{{$ssh->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a class="btn btn-danger btn-xs" onclick="deleteSSH('{{$server->account_id}}', '{{csrf_token()}}')"><span class="fa fa-trash"></span> Delete</a>
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
