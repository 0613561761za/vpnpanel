<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SSH;
use App\Server;
use \phpseclib\Net;

class SSHController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ssh = SSH::get();

        return view('admin.ssh-list')->with('sshs', $ssh);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $sshs = SSH::where('account_id', $id)->first();

        if(!$sshs)
        {
            return abort(503);
        }

        $server_details = Server::where('server_ip', $sshs->account_server)
                                ->where('server_type', 'ssh')
                                ->first();

        if(!$server_details)
        {
            return abort(503);
        }

        $ssh = new Net\SSH2($server_details->server_ip);
        if(!$ssh->login($server_details->server_user,$server_details->server_password))
        {
            return abort(503);
        }

        $ssh->exec('userdel ' . $sshs->account_name);

        return SSH::where('account_id', $id)->delete();
    }
}
