@extends('layouts.app')
@section('title', 'Create Free SSH Account! ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($servers->count() < 1)
                        <h2 style="text-align: center;">Whoops! No server available.</h2>
                    @else
                        @foreach($servers as $server)
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="text-align: center;text-transform: uppercase;font-weight: bold;">{{$server->server_name}}</div>
                                    <div class="panel-body">
                                        <p style="font-weight: bold;text-align: center;">{{$server->server_ip}}</p>
                                        <p style="font-weight: bold;text-align: center;">{{$server->server_host}}</p>
                                        <p style="font-weight: bold;text-align: center;">{{$server->server_country}}</p>
                                        <p style="font-weight: bold;text-align: center;">{{$server->server_port}}</p>
                                        <p style="font-weight: bold;text-align: center;">{{$server->server_limit}}</p>

                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
