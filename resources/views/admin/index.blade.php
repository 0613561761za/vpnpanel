@extends('layouts.app')
@section('title', 'Admin Panel')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>

                <div class="panel-body">
                    <div class="col-md-3">
                        <div class="panel panel-warning">
                            <div class="panel-heading" style="text-align: center;">Add Server</div>
                            <div class="panel-body">
                                <hr />
                                <a class="btn btn-warning" href="{{url('/manage/admin/server/add')}}" style="width: 100%;">Go!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-success">
                            <div class="panel-heading" style="text-align: center;">List Server</div>
                            <div class="panel-body">
                                <hr />
                                <a class="btn btn-success" href="{{url('/manage/admin/server/list')}}" style="width: 100%;">Go!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading" style="text-align: center;">List VPN Account</div>
                            <div class="panel-body">
                                <hr />
                                <a class="btn btn-primary" href="{{url('/manage/admin/vpn/list')}}" style="width: 100%;">Go!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-danger">
                            <div class="panel-heading" style="text-align: center;">Account Setting</div>
                            <div class="panel-body">
                                <hr />
                                <a class="btn btn-danger" href="{{url('/manage/admin/account/setting')}}" style="width: 100%;">Go!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
