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
                                <form id="server-add" method="post" action="{{url('/manage/admin/server/add')}}">
                                    {{csrf_field()}}
                                    <label for="servername">Server Name :</label> 
                                    <input type="text" class="form-control" name="servername" placeholder="Ex: SG-DO 1" required="">  
                                    <label for="serverip">Server IP Address :</label> 
                                    <input type="text" class="form-control" name="serverip" placeholder="Ex: 128.199.21.22" required="">
                                    <label for="serverip">Server Host :</label> 
                                    <input type="text" class="form-control" name="serverhost" placeholder="Ex: s1.sg-do.com" required="">  
                                    <label for="serveruname">Server Username (root) :</label> 
                                    <input type="text" class="form-control" name="serveruser" placeholder="Ex: root" required="">  
                                    <label for="serverpass">Server Password :</label> 
                                    <input type="text" class="form-control" name="serverpassword" placeholder="Ex: P4$$w0rD" required="">  
                                    <label for="servercountry">Server Country :</label> 
                                    <input type="text" class="form-control" name="servercountry" placeholder="Ex: Singapore" required="">  
                                    <label for="serverproto">Server Limit/day :</label> 
                                    <input type="text" class="form-control" name="serverlimit" placeholder="Ex: 500" required="">  
                                    <label for="serverproto">Server Protocol :</label> 
                                    <select class="form-control" id="sel1" name="serverproto" required="">
                                        <option>TCP</option>
                                        <option>UDP</option>
                                    </select>
                                    <label for="serverport">Server Port :</label> 
                                    <input type="text" class="form-control" name="serverport" placeholder="Ex: 80|25|1992|200 (separated by: | )" required="">  
                                    <label for="serverconfig">Server Config Link :</label> 
                                    <input type="text" class="form-control" name="serverconfig" placeholder="Ex: https://domain.com/config/config-1.ovpn" required="">  
                                    <hr />
                                    <button id="btn-add-server" class="btn btn-success" style="width: 100%;text-align: center;">Add!</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2>Do & Don't!</h2>
                                <ul>
                                    <li>You can add unlimited server to this VPN Panel installation</li>
                                    <li>Enter Servername ex: SG-DO 1</li>
                                    <li>Enter server ip (IPV4) VPN Panel doesn't support IPV6 Yet.</li>
                                    <li>Enter very secure password, Combine word and number and character</li>
                                    <li>Select protocol (TCP/UDP)</li>
                                    <li>You can enter one or more server port separated by (|)</li>
                                    <li>Enter active server!</li>
                                    <li>Don't block port 22</li>
                                </ul>
                            </div>
                        </div>
                        <div id="result">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
