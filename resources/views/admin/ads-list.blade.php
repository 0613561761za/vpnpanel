@extends('layouts.app')
@section('title', 'ADS List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome To Admin Panel!</div>

                <div class="panel-body">
                    @if($ads->count() < 1)
                        <h2 style="text-align: center;">NO ADS FOUND.</h2>
                        <hr />
                    @else
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>ADS Name</th>
                                <th>ADS Type</th>
                                <th>ADS Create Date</th>
                                <th>ADS Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($ads as $group)
                                    <tr id="row-{{$group->ads_id}}">
                                        <td>{{$group->ads_id}}</td>
                                        <td>{{$group->ads_name}}</td>
                                        <td>{{$group->ads_type}}</td>
                                        <td>{{$group->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a class="btn btn-warning btn-xs" href="/manage/admin/ads/edit/{{$group->ads_id}}"><span class="fa fa-pencil"></span> Edit</a>
                                            <a class="btn btn-danger btn-xs" onclick="deleteADS({{$group->ads_id}}, '{{csrf_token()}}')"><span class="fa fa-trash"></span> Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                          </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
