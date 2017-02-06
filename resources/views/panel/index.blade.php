@extends('layouts.app')
@section('title', 'Server Panel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <h2 style="text-align: center;">SERVER PANEL MANAGER!</h2>
                        <p style="text-align: center;font-size: 20px;">Here you can help our service more better to help fixing server with your action!</p>
                        <hr />
                        <!-- advertising -->

                        <div class="center-block" style="margin-left: 30%;">
                            {!! @App\Ads::where('ads_type', 'horizontal')->inRandomOrder()->first()->ads_body !!}
                        </div>
                        <hr />
                        <div class="panel panel-success">
                            <div class="panel-heading" style="text-align: center;"><i class="fa fa-tasks"></i> Panel Server!</div>
                            <div class="panel-body">
                                <select class="form-control" id="server-panel-list">
                                       @if($servers->count() < 1)
                                            <option>No Server Found</option>
                                        @else
                                        <option>Select Server</option>
                                        @foreach($servers as $server)
                                            <option>{{$server->server_host}}</option>
                                        @endforeach
                                        @endif
                                </select>
                                <hr />
                                <div style="display: none;" class="col-md-12 col-md-offset-5 col-lg-12 col-lg-offset-4 col-xs-12 col-xs-offset-3 col-sm-12 col-sm-offset-3" id="loading">
                                    <img class="img-responsive" src="/image/loading.gif">
                                </div>
                                <div id="panel-setting">

                                </div>
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
                {!! @App\Ads::where('ads_type', 'vertical')->inRandomOrder()->first()->ads_body !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                </div>
            </div>
        </div>

        

        <div class="col-md-12">
            <hr />
            <p style="text-align: center;font-weight: bold;">Copyright &copy; {{date('Y')}} VPN Panel & Successfully create over {{App\Color::account()}} SSH & VPN Account.</p>
        </div>
    </div>
</div>
@endsection
