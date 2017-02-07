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
                    		<form id="edit-ads" method="post" action="/manage/admin/server/ads/edit/{{$ads->ads_id}}">
                    			{{csrf_field()}}
                          <input type="hidden" id="ads-id" value="{{$ads->ads_id}}">
                    			<label for="adsname">Ads Name :</label>
                    			<input type="text" class="form-control" name="adsname" placeholder="Ex: ads 1" value="{{$ads->ads_name}}">
                    			<label for="adstype">Ads Type : </label>
                    			<select class="form-control" name="adstype" value="{{$ads->ads_type}}">
                    				<option>vertical</option>
                    				<option>horizontal</option>
                    				<option>responsive</option>
                    			</select>
                    			<label>Ads Code (HTML) : </label>
                    			<textarea class="form-control" name="adscode" placeholder="Ads Code" rows="5">{{$ads->ads_body}}</textarea>
                    			<hr />
                    			<button id="btn-edit-ads" class="btn btn-success" style="text-align: center;width: 100%;" type="submit">Save!</button>
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
