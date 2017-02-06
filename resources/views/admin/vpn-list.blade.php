@extends('layouts.app')
@section('title', 'VPN User List');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>
                    <div class="panel-body">
                        @if($servers->count() < 1 )
                            <h2 style="text-align: center;">NO VPN SERVER FOUND.</h2>
                        @else
                            @foreach($servers as $server)
                                <div class="col-md-3 col-lg-3 col-xs-12">
                                    <div class="panel panel-warning">
                                        <div class="panel-heading" style="text-align: center;">{{$server->server_name}}</div>
                                        <div class="panel-body">
                                            <hr />
                                            <a class="btn btn-warning" style="width: 100%;" href="{{url('/manage/admin/vpn/user/' . $server->server_id . '/list')}}">View User</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
