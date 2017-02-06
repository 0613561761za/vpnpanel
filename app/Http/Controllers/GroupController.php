<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Server;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = Group::get();

        return view('admin.group-list')->with('groups', $group);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!preg_match("/\|/", $request->grouplist))
        {
            $grouplist = "|" . $request->grouplist;
        }
        else
        {
            $grouplist = $request->grouplist;
        }

        Group::create([
            'group_name' => $request->groupname,
            'group_country' => $request->groupcountry,
            'group_country_list' => $grouplist,
            'group_count' => 0,
        ]);

        return response()->json([
            'status' => 'success',
            'messages' => 'Group sucecssfully created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $group = Group::where('group_id',$id)->first();

    	if(!$group)
    	{
    		return abort(404);
    	}

        $server = Server::where('server_group', $group->group_name)->get();
        if(!$server)
        {
            return abort(404);
        }

	    return view('group-server')->with('servers', $server);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::where('group_id', $id)->first();

        if(!$group)
        {
            return abort(500);
        }

        return Group::where('group_id', $id)->delete();
    }
}
