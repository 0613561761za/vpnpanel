<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\VPN;
use App\User;
use App\Group;
use Carbon\Carbon;
use \phpseclib\Net;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $server = Server::get();
        $geoip  = $this->curl('http://freegeoip.net/json');
        $group  = Group::get();



        return view('welcome')-> with('servers', $server) 
                              -> with('geo', json_decode($geoip))
                              -> with('groups', $group);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('create')->with('server_id',$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $now = Carbon::now();

        $server = Server::where('server_id', $request->server_id)->first();
        if(!$server)
        {
            return abort(401);
        }

        $ifUserExists = VPN::where('account_name', $request->username)
                          -> where('account_server', $server->server_ip)
                          -> first();
        if(!$ifUserExists)
        {

            // check if server limited.

            if($server->server_is_limit == $server->server_limit)
            {
                return response()->json([
                    'status' => 'limited',
                    'username' => $request->username,
                    'password' => $request->password,
                ]);
            }

            // send command to server. 

            $ssh = new Net\SSH2($server->server_ip);
            if(!$ssh->login($server->server_user,$server->server_password))
            {
                return abort(503);
            }

            $ssh->exec('useradd ' . $request->username . ' -m -s /bin/false');
            $ssh->exec('echo ' . $request->username . ':' . $request->password . ' | chpasswd');

            // insert to database

            VPN::create([
                'account_name' => $request->username,
                'account_password' => $request->password,
                'account_server' => $server->server_ip,
                'account_create' => Carbon::now(),
                'account_expired' => $now->addDays(14),
            ]);

            Server::where('server_id', $request->server_id)
                 -> increment('server_is_limit');


            // send result.

            return response()->json([
                'status' => 'success',
                'username' => $request->username,
                'password' => $request->password,
                'created' => date('d/m/Y'),
                'expired' => $now->addDays(7)->diffForHumans(),
                'config' => $server->server_config,
            ]); 
        
        }


        
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
    public function update(Request $request)
    {
        if(!isset($request->cnpassword))
        {
            // change email
            $user = User::where('email', $request->oldemail)->first();
            if(!$user)
            {
                return abort(404);
            }

            if(!Hash::check($request->cpassword, $user->password))
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password confirmation error!' 
                ]);
            }

            User::where('email', $request->oldemail)
               -> update(['email' => $request->cemail]); 
            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully!'
            ]);

        }


        $user = User::where('email', $request->oldemail)->first();
        if(!$user)
        {
            return abort(404);
        }

        if($request->cnpassword != $request->cnpassword_confirmation)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Confirmation password doesn\'t match!'
            ]);
        }

        User::where('email', $request->oldemail)
           -> update(['password' => Hash::make($request->cnpassword)]);
        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully!',
        ]);

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

    public function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        $result = curl_exec($ch);
        return $result;
    }
}
