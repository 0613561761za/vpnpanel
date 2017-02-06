@extends('layouts.app')
@section('title', 'DNS List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;">Welcome To Admin Panel!</div>

                <div class="panel-body">
                    @if($dnss->count() < 1)
                        <h2 style="text-align: center;">NO DNS FOUND.</h2>
                        <hr />
                    @else
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>DNS Name</th>
                                <th>DNS Domain</th>
                                <th>DNS Create Date</th>
                                <th>Squid Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($dnss as $group)
                                    <tr id="row-{{$group->domain_id}}">
                                        <td>{{$group->domain_id}}</td>
                                        <td>{{$group->domain_name}}</td>
                                        <td>{{$group->domain_domain}}</td>
                                        <td>{{$group->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a class="btn btn-danger btn-xs" onclick="deleteDomain({{$group->domain_id}}, '{{csrf_token()}}')"><span class="fa fa-trash"></span> Delete</a>
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
