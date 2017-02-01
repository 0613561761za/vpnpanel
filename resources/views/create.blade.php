@extends('layouts.app')
@section('title', 'Create Premium VPN Account!.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(!isset($server_id))
                        {{abort(404)}}
                    @else

                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-body">
                                    <form id="create" method="post" action="{{url('/create/' . $server_id)}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="server_id" value="{{$server_id}}">
                                        <label for="username"> VPN Username :</label>
                                        <input id="username" type="text" class="form-control" name="username" placeholder="Username" required="">
                                        <label for="password"> VPN Password :</label>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="">
                                        <hr />
                                        <button id="btn-create" class="btn btn-success" style="text-align: center;width: 100%;">Create!</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-body">
                                    <h2>Do & Don't!</h2>
                                    <ul>
                                        <li>No DDOS.</li>
                                        <li>No Hacking.</li>
                                        <li>No Carding.</li>
                                        <li>No Torent.</li>
                                        <li>No Phising.</li>
                                        <li>No Multi Login..</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    @endif

                    <div id="result" class="col-lg-12 col-md-12 col-xs-12">
                        
                    </div>

                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <hr />  
                        <p style="text-align: center;font-weight: bold;">Copyright {{date('Y')}} VPN Panel.</p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
