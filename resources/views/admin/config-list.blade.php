@extends('layouts.app')
@section('title', 'VPN Config List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>

                <div class="panel-body">
                    @if($configs->count() < 1)
                    	<div class="alert alert-info" style="text-align: center;">
                    		VPN Config digunakan untuk menghubungkan VPN Client ke server biasanya melalui protocol TCP & UDP
                    	</div>
                    	<h2 style="text-align: center;">NO VPN CONFIG FOUND.</h2>
                    	<hr />
                    	<a style="width: 100%;text-align: center;" class="btn btn-success" href="/manage/admin/config/add">Upload Now!</a>
                    @else
                    	<div class="table-responsive">          
	                      <table class="table">
	                        <thead>
	                          <tr>
	                            <th>#</th>
	                            <th>Config Name</th>
	                            <th>Config Server</th>
	                            <th>Config Type</th>
	                            <th>Config Server</th>
	                            <th>Config Upload At</th>
	                            <th>Config Action</th>
	                          </tr>
	                        </thead>
	                        <tbody>
	                            @foreach($configs as $config)
	                                <tr id="row-{{$config->config_id}}">
	                                    <td>{{$config->config_id}}</td>
	                                    <td>{{$config->config_name}}</td>
	                                    <td>{{$config->config_server}}</td>
	                                    <td>{{$config->config_type}}</td>
	                                    <td>{{$config->config_server}}</td>
	                                    <td>{{$config->created_at->diffForHumans()}}</td>
	                                    <td>
	                                        <a class="btn btn-warning btn-xs" href="/download/config/{{$config->config_id}}"><span class="fa fa-download"></span> Download</a>
	                                        <a class="btn btn-danger btn-xs" onclick="deleteConfig('{{$config->config_id}}', '{{csrf_token()}}')"><span class="fa fa-trash"></span> Delete</a>
	                                    </td>
	                                </tr>
	                            @endforeach
	                        </tbody>
	                      </table>
	                    </div>
	                    <hr />
	                    <a class="btn btn-success" href="/manage/admin/config/add" style="width: 100%;text-align: center;">
	                    	Upload More!
	                    </a>
	                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
