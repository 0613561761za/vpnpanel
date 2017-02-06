@extends('layouts.app')
@section('title', 'Create Premium VPN Account!.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <h2 style="text-align: center;">VPN CONFIG DOWNLOAD!</h2>
                        <p style="text-align: center;font-size: 20px;">Here you can download all our VPN Server config with TCP/UDP or even TCP&UDP Protocol!</p>
                        <hr />
                        <!-- advertising -->

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                        </div>
                        <hr />
                        <div class="panel panel-primary">
                        	<div class="panel panel-heading" style="text-align: center;"><i class="fa fa-download"></i> &nbsp; VPN Config Downloader</div>
                            <div class="panel-body">
                        		@if($configs->count() < 1)
                                    <h2 style="text-align: center;">NO VPN CONFIG FOUND.</h2>
                                @else
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Config Name</th>
                                        <th>Config Server</th>
                                        <th>Config Protocol</th>
                                        <th>Config Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($configs as $config)
                                        <tr>
                                            <td>{{$config->config_id}}</td>
                                            <td>{{$config->config_name}}</td>
                                            <td>{{$config->config_server}}</td>
                                            <td>{{$config->config_type}}</td>
                                            <td>
                                                <a id="download-config" class="btn btn-success" href="/config-file/{{$config->config_filename}}"><i class="fa fa-download"></i> &nbsp; Download</a>
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
