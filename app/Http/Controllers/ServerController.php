<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $server = Server::get();

        return view('admin.server-list')->with('servers', $server);
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
        $server = Server::where('server_ip', $request->serverip)->first();
        if(!$server)
        {
            // insert server to database
            Server::create([
                'server_name' => $request->servername,
                'server_ip' => $request->serverip,
                'server_host' => $request->serverhost,
                'server_user' => $request->serveruser,
                'server_password' => $request->serverpassword,
                'server_country' => $request->servercountry,
                'server_protocol' => $request->serverproto,
                'server_port' => $request->serverport,
                'server_limit' => $request->serverlimit,
                'server_is_limit' => 0,
                'server_config' => $request->serverconfig,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Server successfully added!'
            ]);
        } 

        return response()->json([
            'status' => 'exists',
            'message' => 'Server with IP ' . $request->serverip . ' already added!',
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
        $server = Server::where('server_id', $id)->first();
        if(!$server)
        {
            return abort(404);
        }

        return view('admin.show-server')->with('server', $server);
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
        return Server::where('server_id', $id)->delete();
    }
}
