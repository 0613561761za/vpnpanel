@extends('layouts.app')
@section('title', 'VPN User List');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome to admin panel!</div>
                    <div class="panel-body">
                        @if(!isset($server))
                            {{abort(404)}}
                        @else
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
