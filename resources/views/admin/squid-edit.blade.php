@extends('layouts.app')
@section('title', 'Add Squid Proxy')
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
                    		<h2>Edit Squid Proxy</h2>
                    		<form id="squid-edit" method="post" action="/manage/admin/squid/add">
                    			{{csrf_field()}}
                          <input type="hidden" id="squid-id" value="{{$squid->squid_id}}">
                    			<label for="groupname">Squid IP :</label>
                    			<input value="{{$squid->squid_ip}}" type="text" class="form-control" name="squid_ip" placeholder="Ex: 128.199.xx.xx">
                    			<label for="groupcountry">Squid Port : </label>
                    			<input value="{{$squid->squid_port}}" type="text" class="form-control" name="squid_port" placeholder="Ex: 8000">
                    		    <hr />
                    			<button id="btn-edit-squid" class="btn btn-success" style="text-align: center;width: 100%;" type="submit">Save!</button>
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
