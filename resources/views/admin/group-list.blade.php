@extends('layouts.app')
@section('title', 'Server Group')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome To Admin Panel!</div>

                <div class="panel-body">
                    @if($groups->count() < 1)
                        <div class="alert alert-info" style="text-align: center;">
                            Group digunakan untuk mengelompokan server tergantung asal server tersebut, seperti Asia, Eropa, Africa dll.
                        </div>
                        <h2 style="text-align: center;">NO SERVER GROUP FOUND.</h2>
                        <hr />
                        <a style="width: 100%;text-align: center;" href="{{url('/manage/admin/server/group/add')}}" class="btn btn-success">Create Now!</a>
                    @else
                        <div class="alert alert-info" style="text-align: center;">
                            Group digunakan untuk mengelompokan server tergantung asal server tersebut, seperti Asia, Eropa, Africa dll.
                        </div>
                        <div class="table-responsive">          
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Group Name</th>
                                <th>Group Country</th>
                                <th>Group Server Count</th>
                                <th>Group Create Date</th>
                                <th>Group Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($groups as $group)
                                    <tr id="row-{{$group->group_id}}">
                                        <td>{{$group->group_name}}</td>
                                        <td>{{$group->group_country}}</td>
                                        <td>{{$group->group_count}}</td>
                                        <td>{{$group->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-xs" onclick="deleteGroup({{$group->group_id}}, '{{csrf_token()}}')"><span class="fa fa-trash"></span> Delete</a>
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
