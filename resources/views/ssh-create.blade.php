@extends('layouts.app')
@section('title', 'Create Premium SSH & VPN Account!.')
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

                        <div class="center-block" style="margin-left: 30%;">
                            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                        </div>
                        <hr />
                        <div class="panel panel-warning">
                            <div class="panel-body"> 
                                <div class="col-md-6">
                                	<div class="panel panel-warning">
                                		<div class="panel-body">
	                                		<form method="post" action="/ssh/create/{{$server_id}}" id="create-ssh">
	                                			{{csrf_field()}}
	                                			<input type="hidden" name="server_id" id="server_id" value="{{$server_id}}">
	                                			<label>SSH Username</label>
	                                			<input type="text" name="username" class="form-control" placeholder="username" required>
	                                			<label>SSH Password</label>
	                                			<input type="password" name="password" class="form-control" placeholder="password" required>
	                                			<hr />
	                                			<div class="g-recaptcha" data-sitekey="{{$cpc}}"></div>
	                                			<hr />
	                                			<button id="btn-create-ssh" class="btn btn-warning" type="submit" style="width: 100;text-align: center;">Create!</button>
	                                			<div id="loading"></div>
	                                		</form>
                                		</div>
                                	</div>
                            	</div> 
                            	<div class="col-md-6" id="ssh-result">
                                	{!! @App\Ads::where('ads_type', 'responsive')->first()->ads_body !!}
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
                {!! @App\Ads::where('ads_type', 'vertical')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
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
