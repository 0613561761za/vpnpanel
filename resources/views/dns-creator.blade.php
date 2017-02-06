@extends('layouts.app')
@section('title', 'Create Premium VPN Account!.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <h2 style="text-align: center;">Free Premium SSH & VPN Server!</h2>
                        <p style="text-align: center;font-size: 20px;">Don't worry about your internet connection now! with our services your connection will be secured!</p>
                        <hr />
                        <!-- advertising -->

                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                        </div>
                        <hr />
                        <div class="panel panel-warning">
                        	<div class="panel panel-heading" style="text-align: center;"><i class="fa fa-cloud"></i> &nbsp; DNS Record Creator</div>
                            <div class="panel-body">
                        		<form id="dns-creator" method="post" action="/tools/dns-creator">
                                    {{csrf_field()}}
                                    <div class="col-md-4">
                                        <label>Hostname</label>
                                        <input type="text" class="form-control" name="hostname" placeholder="opx.opera-host">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Domain</label>
                                        <select class="form-control" name="domain">
                                            @if($servers->count() < 1)
                                                <option>No DNS Available</option>
                                            @else
                                                <option>Select Domain</option>
                                            @foreach($servers as $server)
                                                <option>{{$server->domain_domain}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>IP Address</label>
                                        <input type="text" class="form-control" name="ip" placeholder="192.168.xx.xx">
                                    </div>
                                    <div class="col-md-12">
                                        <hr />
                                        <button id="btn-create-dns" class="btn btn-warning" style="text-align: center;width: 100%;">Create!</button>
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
        <div class="col-md-12">
          {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
        </div>

        <div class="col-md-12">
            <hr />
            <p style="text-align: center;font-weight: bold;">Copyright &copy; {{date('Y')}} VPN Panel & Successfully create over {{App\Color::account()}} SSH & VPN Account.</p>
        </div>
    </div>
</div>
@endsection
