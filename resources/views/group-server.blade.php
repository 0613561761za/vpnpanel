@extends('layouts.app')
@section('title', 'Create Premium VPN Account!.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <h2 style="text-align: center;">LIST SERVER GROUP!</h2>
                        <p style="text-align: center;font-size: 20px;">This is all server under this group!</p>
                        <hr />
                        <!-- advertising -->

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                        </div>
                        <hr />
                        <div class="panel panel-success">
                            <div class="panel-body">
                                @if($servers->count() < 1)
                                    <h2 style="text-align: center;">Whoops! No Server Found.</h2>
                                @else
                                @foreach($servers as $server)
                                    <div class="col-md-3 col-xs-12 col-lg-3">
                                        <div class="panel panel-success">
                                            <div class="panel-heading" style="text-transform: uppercase;font-weight: bold;text-align: center;">{{$server->server_name}}</div>
                                            <div class="panel-body">
                                                <p style="text-align: center;font-weight: bold;">IP: {{$server->server_ip}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Host: {{$server->server_host}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Service: {{$server->server_type}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Country: {{$server->server_country}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Ports: {{$server->server_port}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Active Day: {{$server->server_account_expired}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Daily Limit: {{$server->server_limit}} days.</p>
                                                <hr />
                                                <a href="{{url('/' . $server->server_type . '/create/' . $server->server_id)}}" class="btn btn-warning" style="width: 100%;text-align: center;">Create!</a>
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
        <div class="col-md-2">
            <div class="panel panel-default visible-lg">
                <div class="panel-heading" style="text-align: center;">advertising</div>
                <div class="panel-body">
                {!! @App\Ads::where('ads_type', 'vertical')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
        </div>
        <div class="col-md-12">
            <hr />
            <p style="text-align: center;font-weight: bold;">Copyright &copy; {{date('Y')}} VPN Panel & Successfully create over {{App\Color::account()}} SSH & VPN Account.</p>
        </div>
    </div>
</div>
@endsection
