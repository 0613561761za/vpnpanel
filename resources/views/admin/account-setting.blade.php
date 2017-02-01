@extends('layouts.app')
@section('title', 'VPN Account List');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>
                <div class="panel-body">

                    <div class="col-lg-6 col-md-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form id="change-email" method="post" action="{{url('/manage/admin/account/setting')}}">
                                    <h3>Change Email Address.</h3>
                                    <hr />
                                    {{csrf_field()}}
                                    <label for="email">Old Email Address :</label>
                                    <input type="text" class="form-control" name="oldemail" value="{{Auth::user()->email}}" readonly>
                                    <label for="email">New Email Address :</label>
                                    <input type="text" class="form-control" name="cemail">
                                    <label>Confirm Password :</label>
                                    <input type="password" class="form-control" name="cpassword">
                                    <hr />
                                    <button id="btn-change-email" class="btn btn-success" style="width: 100%;">Change!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form id="change-password" method="post" action="{{url('/manage/admin/account/setting')}}">
                                    <h3>Change Password.</h3>
                                    <hr />
                                    {{csrf_field()}}
                                    <label for="email">Old Email Address :</label>
                                    <input type="text" class="form-control" name="oldemail" value="{{Auth::user()->email}}" readonly>
                                    <label for="email">New Password :</label>
                                    <input type="password" class="form-control" name="cnpassword">
                                    <label for="email">Confirm Password :</label>
                                    <input type="password" class="form-control" name="cnpassword_confirmation">
                                    <hr />
                                    <button id="btn-change-password" class="btn btn-success" style="width: 100%;">Change!</button>
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
