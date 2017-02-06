@extends('layouts.app')
@section('title', 'Add Server Group')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>

                <div class="panel-body">
                    <div class="col-md-6 col-lg-6 col-xs-12">
                    	<div class="panel panel-default">
                    		<div class="panel-body">
                    		<h2>Add VPN Config</h2>
                    		@if(isset($success))
                    			<div class="alert alert-success">
                    				{{$success}}
                    			</div>
                    		@endif
                            @if(isset($failed))
                                <div class="alert alert-danger">
                                    {{$failed}}
                                </div>
                            @endif
                    		<form method="post" action="/manage/admin/config/add" enctype="multipart/form-data">
                    			{{csrf_field()}}
                    			<label for="groupname">Config Name :</label>
                    			<input type="text" class="form-control" name="configname" placeholder="Ex: sg-1.serverip.co">
                    			<label for="groupcountry">Config Server : </label>
                    			<select class="form-control" name="configserver">
                    				@if($servers->count() < 1)
                    					<option>No Server Available!</option>
                    				@else
		                				@foreach($servers as $server)
		                					<option>{{$server->server_host}}</option>
		                				@endforeach
		                			@endif
                    			</select>
                    			<label for="groupcountry">Config Protocol : </label>
                    			<select class="form-control" name="configproto">
                    				<option>TCP</option>
                    				<option>UDP</option>
                    				<option>TCP & UDP</option>
                    			</select>
                    			<label for="grouplist">Config File :</label>
                    			<input type="file" name="configfile" class="form-control">
                    			<hr />
                    			<button class="btn btn-success" style="text-align: center;width: 100%;" type="submit">Upload!</button>
                    		</form>
                    		</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
