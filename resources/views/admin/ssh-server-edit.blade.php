@extends('layouts.app')
@section('title', 'Add new server!');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>
                <div class="panel-body">
                    <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2>SSH Server</h2>
                                <form id="ssh-server-edit" method="post" action="{{url('/manage/admin/server/add')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" id="ssh-id" value="{{$server->server_id}}">
                                    <label for="servername">Server Name :</label>
                                    <input type="text" class="form-control" name="servername" placeholder="Ex: SG-DO 1" required="" value="{{$server->server_name}}">
                                    <label for="serverip">Server IP Address :</label>
                                    <input type="text" class="form-control" name="serverip" placeholder="Ex: 128.199.21.22" required="" value="{{$server->server_ip}}">
                                    <label for="serverip">Server Host :</label>
                                    <input type="text" class="form-control" name="serverhost" placeholder="Ex: s1.sg-do.com" required="" value="{{$server->server_host}}">
                                    <label for="serveruname">Server Username (root) :</label>
                                    <input type="text" class="form-control" name="serveruser" placeholder="Ex: root" required="" value="{{$server->server_user}}">
                                    <label for="serverpass">Server Password :</label>
                                    <input type="text" class="form-control" name="serverpassword" placeholder="Ex: P4$$w0rD" required="" >
                                    <label for="servercountry">Server Country :</label>
                                    <input type="text" class="form-control" name="servercountry" placeholder="Ex: Singapore" required="" value="{{$server->server_country}}">
                                    <label for="serverproto">Server Limit/day :</label>
                                    <input type="text" class="form-control" name="serverlimit" placeholder="Ex: 500" required="" value="{{$server->server_limit}}">
                                    <label for="serverproto">Server Account Expired :</label>
                                    <input type="text" class="form-control" name="serverexpired" placeholder="Ex: 7 (7 = 7 hari)" required="" value="{{$server->server_account_expired}}">
                                    <label for="serverport">Server Port :</label>
                                    <input type="text" class="form-control" name="serverport" placeholder="Ex: 80|25|1992|200 (separated by: | )" required="" value="{{$server->server_port}}">
                                    <label>Server Group</label>
                                    <select id="ssh-protocol" class="form-control" name="servergroup" required="">
                                        @if($groups->count() <1 )
                                            <option>No Groups Available</option>
                                        @else
                                            @foreach($groups as $group)
                                                <option>{{$group->group_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <hr />
                                    <button id="btn-edit-ssh-server" class="btn btn-success" style="width: 100%;text-align: center;">Add!</button>
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
