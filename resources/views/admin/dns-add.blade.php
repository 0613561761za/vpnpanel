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
                    		<h2>Add DNS</h2>
                    		<form id="dns-add" method="post" action="/manage/admin/server/group/add">
                    			{{csrf_field()}}
                    			<label for="dnsname">DNS Name :</label>
                    			<input type="text" class="form-control" name="dnsname" placeholder="Ex: dns1/dns2/dns3">
                    			<label for="groupcountry">DNS Domain : </label>
                    			<input type="text" class="form-control" name="dnsdomain" placeholder="Ex: zxc.id/zxc.pm/dns1.com">
                    			<hr />
                    			<button id="btn-add-dns" class="btn btn-success" style="text-align: center;width: 100%;" type="submit">Create!</button>
                    		</form>
                    		</div>
                    	</div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xs-12">
                    	<div class="alert alert-info">
                    		DNS is used to pointing numeric ipv4 into a alphanumeric domain name.
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
