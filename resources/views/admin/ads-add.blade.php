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
                    		<h2>Add Ads</h2>
                    		<form id="ads-add" method="post" action="/manage/admin/server/group/add">
                    			{{csrf_field()}}
                    			<label for="adsname">Ads Name :</label>
                    			<input type="text" class="form-control" name="adsname" placeholder="Ex: ads 1">
                    			<label for="adstype">Ads Type : </label>
                    			<select class="form-control" name="adstype">
                    				<option>vertical</option>
                    				<option>horizontal</option>
                    				<option>responsive</option>
                    			</select>
                    			<label>Ads Code (HTML) : </label>
                    			<textarea class="form-control" name="adscode" placeholder="Ads Code" rows="5"></textarea>
                    			<hr />
                    			<button id="btn-add-ads" class="btn btn-success" style="text-align: center;width: 100%;" type="submit">Create!</button>
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
