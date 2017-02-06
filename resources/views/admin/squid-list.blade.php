@extends('layouts.app')
@section('title', 'Squid List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome To Admin Panel!</div>

                <div class="panel-body">
                    @if($squids->count() < 1)
                        <h2 style="text-align: center;">NO SQUID PROXY FOUND.</h2>
                        <hr />
                        <a style="width: 100%;text-align: center;" href="{{url('/manage/admin/squid/add')}}" class="btn btn-success">Add Now!</a>
                    @else
                        <div class="table-responsive">          
                          <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Squid IP</th>
                                <th>Squid Port</th>
                                <th>Squid Create Date</th>
                                <th>Squid Status</th>
                                <th>Squid Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($squids as $group)
                                    <tr id="row-{{$group->squid_id}}">
                                        <td>{{$group->squid_id}}</td>
                                        <td>{{$group->squid_ip}}</td>
                                        <td>{{$group->squid_port}}</td>
                                        <td>{{$group->created_at->diffForHumans()}}</td>
                                        <td>{!!($group->status == true) ? '<label class="label label-success">Online</label>' : '<label class="label label-danger">Offline</label>'!!}</td>
                                        <td>
                                            <a class="btn btn-danger btn-xs" onclick="deleteSquid({{$group->squid_id}}, '{{csrf_token()}}')"><span class="fa fa-trash"></span> Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                          </table>
                        </div>
                        <a class="btn btn-success" style="text-align: center; width: 100%" href="/manage/admin/squid/add">Add More!</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
