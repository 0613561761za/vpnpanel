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
                    		<h2>Edit Server Group</h2>
                    		<form id="group-edit" method="post" action="/manage/admin/server/group/add">
                    			{{csrf_field()}}
                          <input type="hidden" id="group-id" value="{{$group->group_id}}">
                    			<label for="groupname" >Group Name :</label>
                    			<input value="{{$group->group_name}}" type="text" class="form-control" name="groupname" placeholder="Ex: group1/group2/GroupAsia">
                    			<label for="groupcountry" >Group Country : </label>
                    			<input value="{{$group->group_country}}" type="text" class="form-control" name="groupcountry" placeholder="Ex: Asia/America/Africa">
                    			<label for="grouplist">Group Country List :</label>
                    			<textarea class="form-control" name="grouplist" placeholder="Negara server yang kemungkinan ada, misalnya kalo asia Singapore|Indonesia|Malaysia, Pisahkan dengan | " rows="5">{{$group->group_country_list}}</textarea>
                    			<hr />
                    			<button id="btn-edit-group" class="btn btn-success" style="text-align: center;width: 100%;" type="submit">Save!</button>
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
