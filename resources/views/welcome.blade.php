@extends('layouts.app')
@section('title', 'Create Premium VPN Account!.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <h2 style="text-align: center;">Free Premium SSH & VPN Server!</h2>
                        <p style="text-align: center;font-size: 20px;">Don't worry about your internet connection now! with our services your connection will be secured!</p>
                        <hr />
                        <!-- advertising -->

                        <div class="center-block">
                            {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                        </div>
                        <hr />
                        <div class="panel panel-warning">
                            <div class="panel-body">
                                <h4 style="margin-left: 20px;font-weight: bold;text-align: center;">Your IP : <label class="label label-success">{{$geo->ip}}</label></h4>
                                <h4 style="margin-left: 20px;font-weight: bold;text-align: center;">Your City : <label class="label label-warning">{{$geo->city}}</label></h4>
                                <h4 style="margin-left: 20px;font-weight: bold;text-align: center;">Your Region : <label class="label label-primary">{{$geo->region_name}}</label></h4>
                                <h4 style="margin-left: 20px;font-weight: bold;text-align: center;">Your Region Code : <label class="label label-default">{{$geo->region_code}}</label></h4>
                                <h4 style="margin-left: 20px;font-weight: bold;text-align: center;">Your Country : <label class="label label-danger">{{$geo->country_name}}</label></h4>
                                <h4 style="margin-left: 20px;font-weight: bold;text-align: center;">Your Country Code : <label class="label label-success">{{$geo->country_code}}</label></h4>
                                <h4 style="margin-left: 20px;font-weight: bold;text-align: center;">Your Latitude : <label class="label label-warning">{{$geo->latitude}}</label></h4>
                                <h4 style="margin-left: 20px;font-weight: bold;text-align: center;">Your Longitude : <label class="label label-primary">{{$geo->longitude}}</label></h4>
                                <h4 style="margin-left: 20px;font-weight: bold;text-align: center;">Your Timezone : <label class="label label-success">{{$geo->time_zone}}</label></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default visible-lg">
                <div class="panel-heading" style="text-align: center;">advertising</div>
                <div class="panel-body">
                {!! @App\Ads::where('ads_type', 'vertical')->inRandomOrder()->first()->ads_body !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! @App\Ads::where('ads_type', 'horizontal')->orWhere('ads_type', 'responsive')->inRandomOrder()->first()->ads_body !!}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <h2 style="text-align: center;">Choose from Our Server groups!</h2>
            <hr />
            @if($groups->count() < 1)
                <p style="text-align: center;">Whoops! But no server installed :(</p>
            @else
            @foreach($groups as $group)
                <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">Select Server {{$group->group_country}}</div>
                        <div class="panel-body">
                        <h4>Country List</h4>
                            <ul>
                                @foreach(@App\Color::explode($group->group_country_list) as $country)
                                    <li>{{$country}}</li>
                                @endforeach
                            </ul>
                            <hr />
                            <a class="btn btn-danger" style="width: 100%" href="/groups/{{$group->group_id}}">Discover!</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>

        <div class="col-md-12">
            <hr />
            <p style="text-align: center;font-weight: bold;">Copyright &copy; {{date('Y')}} VPN Panel & Successfully create over {{App\Color::account()}} SSH & VPN Account.</p>
        </div>
    </div>
</div>
@endsection
