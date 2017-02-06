@extends('layouts.app')
@section('title', 'Create Premium VPN Account!.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <h2 style="text-align: center;">SQUID PROXY LIST!</h2>
                        <p style="text-align: center;font-size: 20px;">Here you can get all our squid proxy!</p>
                        <hr />
                        <!-- advertising -->

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                        </div>
                        <hr />
                        <div class="panel panel-primary">
                        	<div class="panel panel-heading" style="text-align: center;"><i class="fa fa-globe"></i> &nbsp; Squid Proxy</div>
                            <div class="panel-body">
                        		@if($squids->count() < 1)
                                    <h2 style="text-align: center;">NO SQUID FOUND.</h2>
                                @else
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Squid IP</th>
                                        <th>Squid Port</th>
                                        <th>Squid Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($squids as $config)
                                        <tr>
                                            <td>{{$config->squid_id}}</td>
                                            <td>{{$config->squid_ip}}</td>
                                            <td>{{$config->squid_port}}</td>
                                            <td>{!!($config->status == true) ? '<label class="label label-success label-lg">Online</label>' : '<label class="label label-danger">Offline</label>'!!}</td>
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
        </div>
        <div class="col-md-2">
            <div class="panel panel-default visible-lg">
                <div class="panel-heading" style="text-align: center;">advertising</div>
                <div class="panel-body">
                {!! @App\Ads::where('ads_type', 'vertical')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
        </div>

        <div class="col-md-12">
            <hr />
            <p style="text-align: center;font-weight: bold;">Copyright &copy; {{date('Y')}} {{config('app.name')}} & Successfully create over {{App\Color::account()}} SSH & VPN Account.</p>
        </div>
    </div>
</div>
@endsection
