@extends('layouts.app')
@section('title', 'Create Premium VPN Account!.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <h2 style="text-align: center;">CREATE SSH ACCOUNT!</h2>
                        <p style="text-align: center;font-size: 20px;">SSH is an secure shell to build a secure communication with remote server, SSH Usually works on port 22, 443, and another ports!</p>
                        <hr />
                        <!-- advertising -->

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                        </div>
                        <hr />
                        <div class="panel panel-warning">
                            <div class="panel-body">
                                @if($sshs->count() < 1)
                                    <h2 style="text-align: center;">Whoops! No SSH Server found.</h2>
                                @else
                                @foreach($sshs as $ssh)
                                    <div class="col-md-3 col-xs-12 col-lg-3">
                                        <div class="panel panel-warning">
                                            <div class="panel-heading" style="text-transform: uppercase;font-weight: bold;text-align: center;">{{$ssh->server_name}}</div>
                                            <div class="panel-body">
                                                <p style="text-align: center;font-weight: bold;">IP: {{$ssh->server_ip}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Host: {{$ssh->server_host}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Country: {{$ssh->server_country}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Ports: {{$ssh->server_port}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Active Day: {{$ssh->server_account_expired}}</p>
                                                <hr />
                                                <p style="text-align: center;font-weight: bold;">Daily Limit: {{$ssh->server_limit}} days.</p>
                                                <hr />
                                                <a href="{{url('/ssh/create/' . $ssh->server_id)}}" class="btn btn-warning" style="width: 100%;text-align: center;">Create!</a>
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
        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
              {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
        </div>
        <div class="col-md-12">
            <hr />
            <p style="text-align: center;font-weight: bold;">Copyright &copy; {{date('Y')}} {{config('app.name')}} & Successfully create over {{App\Color::account()}} SSH & VPN Account.</p>
        </div>
    </div>
</div>
@endsection
