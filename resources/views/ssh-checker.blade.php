@extends('layouts.app')
@section('title', 'SSH Account Checker!')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <h2 style="text-align: center;">SSH ACCOUNT CHECKER!</h2>
                        <p style="text-align: center;font-size: 20px;">Can't connect to our server through SSH? Check here! and make sure your account exists!</p>
                        <hr />
                        <!-- advertising -->

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                        </div>
                        <hr />
                        <div class="panel panel-warning">
                        	<div class="panel panel-heading" style="text-align: center;"><i class="fa fa-cloud"></i> &nbsp; SSH Account Checker</div>
                            <div class="panel-body">
                        		<form id="ssh-checker" method="post" action="/pages/ssh-checker">
                                    {{csrf_field()}}
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Ex: {{$wm}}-sshuser">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Server</label>
                                        <select class="form-control" name="server_host">
                                            @if($servers->count() < 1)
                                                <option>No Server Available</option>
                                            @else
                                                <option>Select Server</option>
                                            @foreach($servers as $server)
                                                <option>{{$server->server_host}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <hr />
                                        <button id="btn-check-ssh" class="btn btn-warning" style="text-align: center;width: 100%;">Check!</button>
                                    </div>
                                    <div class="col-md-12" id="result">

                                    </div>
                                </form>
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
            <p style="text-align: center;font-weight: bold;">Copyright &copy; {{date('Y')}} {{config('app.name')}} & Successfully create over {{App\Color::account()}} SSH & VPN Account.</p>
        </div>
    </div>
</div>
@endsection
