<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use \phpseclib\Net;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $server = Server::get();

        return view('panel.index')->with('servers', $server);
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
    public function show(Request $request)
    {
        $server = Server::where('server_host', $request->server_host)->first();
        if(!$server)
        {
            return response()->json([
                'status' => 'server_error',
                'message' => 'Server doesn\'t exists!'
            ]);
        }

        $ssh = new Net\SSH2($server->server_ip);
        if(!$ssh->login($server->server_user,$server->server_password))
        {
            return abort(503);
        }

        $badvpn     = $ssh->exec('./check-badvpn.sh');
        if($badvpn == "BadVPN Not Running\n")
        {
            $badvpn = false;
        }
        elseif($badvpn == "BadVPN Not Installed\n")
        {
            $badvpn = "undefined";
        }
        elseif($badvpn == "BadVPN Running\n")
        {
            $badvpn = true;
        }
        else
        {
            $badvpn = "undefined";
        }

        $openvpn    = $ssh->exec('./check-openvpn.sh');
        if($openvpn == "OpenVPN Not Running\n")
        {
            $openvpn = false;
        }
        elseif($openvpn == "OpenVPN Not Installed\n")
        {
            $openvpn = "undefined";
        }
        elseif($openvpn == "OpenVPN Running\n")
        {
            $openvpn = true;
        }
        else
        {
            $openvpn = "undefined";
        }

        $dropbear   = $ssh->exec('./check-dropbear.sh');
        if($dropbear == "Dropbear Not Running\n")
        {
            $dropbear = false;
        }
        elseif($dropbear == "Dropbear Not Installed\n")
        {
            $dropbear = "undefined";
        }
        elseif($dropbear == "Dropbear Running\n")
        {
            $dropbear = true;
        }
        else
        {
            $dropbear = "undefined";
        }

        $openssh    = $ssh->exec('./check-openssh.sh');
        if($openssh == "OpenSSH Not Running\n")
        {
            $openssh = false;
        }
        elseif($openssh == "OpenSSH Not Installed\n")
        {
            $openssh = "undefined";
        }
        elseif($openssh == "OpenSSH Running\n")
        {
            $openssh = true;
        }
        else
        {
            $openssh = "undefined";
        }

        $squid      = $ssh->exec('./check-squid.sh');
        if($squid == "Squid Not Running\n")
        {
            $squid = false;
        }
        elseif($squid == "Squid Not Installed\n")
        {
            $squid = "undefined";
        }
        elseif($squid == "Squid Running\n")
        {
            $squid = true;
        }
        else
        {
            $squid = "undefined";
        }

        return response()->json([
            'status' => [
                'vpn' => [
                    'status' => $openvpn,
                    'host' => $request->server_host,
                ],
                'dropbear' => [
                    'status' => $dropbear,
                    'host' => $request->server_host,
                ],
                'badvpn' => [
                    'status' => $badvpn,
                    'host' => $request->server_host,
                ],
                'squid' => [
                    'status' => $squid,
                    'host' => $request->server_host,
                ],
                'openssh' => [
                    'status' => $openssh,
                    'host' => $request->server_host,
                ],
            ],
        ]);

        //return var_dump($request->all());
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
        //
    }

    public function restartDropbear(Request $request)
    {
        $server = Server::where('server_host', $request->server_host)->first();
        if(!$server)
        {
            return abort(503);
        }

        $ssh = new Net\SSH2($server->server_ip);
        if(!$ssh->login($server->server_user,$server->server_password))
        {
            return abort(503);
        }

        $ssh->exec('service dropbear restart');
        $result = $ssh->exec('./check-dropbear.sh');

        if($result == "Dropbear Running\n")
        {
            $result = true;
        }
        elseif($result == "Dropbear Not Installed\n")
        {
            $result = "undefined";
        }
        else
        {
            $result = false;
        }

        return response()->json([
            'status' => [
                'dropbear' => [
                    'status' => $result,
                    'host' => $request->server_host,
                ]
            ]

        ]);
    }

    public function restartOpenVPN(Request $request)
    {
        $server = Server::where('server_host', $request->server_host)->first();
        if(!$server)
        {
            return abort(503);
        }

        $ssh = new Net\SSH2($server->server_ip);
        if(!$ssh->login($server->server_user,$server->server_password))
        {
            return abort(503);
        }

        $ssh->exec('service openvpn restart');
        $result = $ssh->exec('./check-openvpn.sh');

        if($result == "OpenVPN Running\n")
        {
            $result = true;
        }
        elseif($result == "OpenVPN Not Installed\n")
        {
            $result = "undefined";
        }
        else
        {
            $result = false;
        }

        return response()->json([
            'status' => [
                'vpn' => [
                    'status' => $result,
                    'host' => $request->server_host,
                ]
            ]

        ]);   
    }

    public function restartSquid(Request $request)
    {
        $server = Server::where('server_host', $request->server_host)->first();
        if(!$server)
        {
            return abort(503);
        }

        $ssh = new Net\SSH2($server->server_ip);
        if(!$ssh->login($server->server_user,$server->server_password))
        {
            return abort(503);
        }

        $ssh->exec('service squid3 restart');
        $result = $ssh->exec('./check-squid.sh');

        if($result == "Squid Running\n")
        {
            $result = true;
        }
        elseif($result == "Squid Not Installed\n")
        {
            $result = "undefined";
        }
        else
        {
            $result = false;
        }

        return response()->json([
            'status' => [
                'squid' => [
                    'status' => $result,
                    'host' => $request->server_host,
                ]
            ]

        ]);   
    }
}
