@extends('layouts.app')
@section('title', 'Create Premium VPN Account!.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(!isset($servers))

                        <h2 style="text-align: center;">NO SERVER AVAILABLE.</h2>
                    @else
                        @foreach($servers as $server)
                            <div class="col-lg-3 col-md-3 col-xs-12">
                                <div class="panel panel-default">
                                <div class="panel-heading" style="text-align: center;font-weight: bold;">{{$server->server_name}}</div>
                                <div class="panel-body">
                                    <p style="font-weight: bold;text-align:center;">ip address : {{$server->server_ip}}</p>
                                    <hr />
                                    <p style="font-weight: bold;text-align:center;">host : {{$server->server_host}}</p>
                                    <hr />
                                    <p style="font-weight: bold;text-align:center;">country : {{$server->server_country}}</p>
                                    <hr />
                                    <p style="font-weight: bold;text-align:center;">protocol : {{$server->server_protocol}}</p>
                                    <hr />
                                    <p style="font-weight: bold;text-align:center;">port : {{$server->server_port}}</p>
                                    <hr />
                                    <a class="btn btn-success" style="width: 100%" href="{{url('/create/' . $server->server_id)}}">Create Account!</a>
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
@endsection
