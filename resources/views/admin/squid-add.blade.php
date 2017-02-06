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
                    		<h2>Add Squid Proxy</h2>
                    		<form id="squid-add" method="post" action="/manage/admin/squid/add">
                    			{{csrf_field()}}
                    			<label for="groupname">Squid IP :</label>
                    			<input type="text" class="form-control" name="squid_ip" placeholder="Ex: 128.199.xx.xx">
                    			<label for="groupcountry">Squid Port : </label>
                    			<input type="text" class="form-control" name="squid_port" placeholder="Ex: 8000">
                    		    <hr />
                    			<button id="btn-add-squid" class="btn btn-success" style="text-align: center;width: 100%;" type="submit">Add!</button>
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
