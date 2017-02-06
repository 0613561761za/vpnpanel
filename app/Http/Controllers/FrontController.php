<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SSH;
use App\VPN;
use App\Server;
use App\Domain;
use \phpseclib\Net;
use Input;
use App\DNSM;
use App\DNS;
use App\Config;
use App\Squid;

class FrontController extends Controller
{
    public function showSSH()
    {
    	$ssh = Server::where('server_type', 'ssh')->get();

    	return view('ssh-list')->with('sshs', $ssh);
    }

    public function showVPN()
    {
    	$vpn = Server::where('server_type', 'vpn')->get();

    	return view('vpn-list')->with('vpns', $vpn);
    }

    public function createSSH($id)
    {
    	$server = Server::where('server_id', $id)->where('server_type', 'ssh')->first();

    	if(!$server)
    	{
    		return abort(404);
    	}

    	return view('ssh-create')->with('server_id', $id)->with('cpc', Domain::first()->recapctcha_site_key);
    }

    public function postCreateSSH(Request $request)
    {
    	$captcha = new \ReCaptcha\ReCaptcha(Domain::first()->recaptcha_secret_key);
    	$gca = $request['g-recaptcha-response'];
    	$response = $captcha->verify($gca);
    	if(!$response->isSuccess())
    	{
    		return response()->json([
    			'status' => 'captcha_error',
    			'message' => 'Captcha Validation Error!'
    		]);
    	}

    	$server = Server::where('server_id', $request->server_id)->where('server_type', 'ssh')->first();

    	if(!$server)
    	{
    		return abort(503);
    	}

    	$user = SSH::where('account_name', @Domain::first()->watermark . '-' . $request->username)->where('account_server', $server->server_ip)->first();

    	if(!$user)
    	{
    		if($server->server_limit == $server->server_id_limit)
        {
          return response()->json([
            'status' => 'error',
            'message' => 'Daily limit reached!'
          ]);
        }

        //create ssh account
    		$ssh = new Net\SSH2($server->server_ip);
    		if(!$ssh->login($server->server_user,$server->server_password))
    		{
    			return abort(503);
    		}

    		$ssh->exec('sudo useradd ' . @Domain::first()->watermark . '-' . $request->username . ' -m -s /bin/false');
    		$ssh->exec('echo ' . @Domain::first()->watermark . '-' . $request->username . ':' . $request->password . ' | chpasswd');

    		SSH::create([
    			'account_name' => @Domain::first()->watermark . '-' . $request->username,
    			'account_password' => $request->password,
    			'account_server' => $server->server_ip,
    			'account_create' => \Carbon\Carbon::now(),
    			'account_expired' => \Carbon\Carbon::now()->addDays($server->server_account_expired),
    			'account_status' => true,
    		]);

    		return response()->json([
    			'status' => 'success',
    			'result' => [
    				'username' => @Domain::first()->watermark . '-' . $request->username,
    				'password' => $request->password,
    				'created' => date('d-m-Y'),
    				'expired' => \Carbon\Carbon::now()->addDays($server->server_account_expired)->diffForHumans(),
    				'ip' => $server->server_ip,
    				'host' => $server->server_host,
    			],
    			'message' => 'SSH Account created successfully!'
    		]);
    	}

    	return response()->json([
    		'status' => 'exists',
    		'message' => 'Account is already exists!'
    	]);
    }

    public function createVPN($id)
    {
    	$server = Server::where('server_id', $id)->where('server_type', 'vpn')->first();

    	if(!$server)
    	{
    		return abort(404);
    	}

    	return view('vpn-create')->with('server_id', $id)->with('cpc', @Domain::first()->recapctcha_site_key);
    }

    public function postCreateVPN(Request $request)
    {
    	$captcha = new \ReCaptcha\ReCaptcha(Domain::first()->recaptcha_secret_key);
    	$gca = $request['g-recaptcha-response'];
    	$response = $captcha->verify($gca);
    	if(!$response->isSuccess())
    	{
    		return response()->json([
    			'status' => 'captcha_error',
    			'message' => 'Captcha Validation Error!'
    		]);
    	}

    	$server = Server::where('server_id', $request->server_id)->where('server_type', 'vpn')->first();

    	if(!$server)
    	{
    		return abort(503);
    	}

    	$user = VPN::where('account_name', @Domain::first()->watermark . '-' . $request->username)->where('account_server', $server->server_ip)->first();

    	if(!$user)
    	{
    		if($server->server_limit != $server->server_is_limit)
        {
          //create ssh account
      		$ssh = new Net\SSH2($server->server_ip);
      		if(!$ssh->login($server->server_user,$server->server_password))
      		{
      			return abort(503);
      		}

      		$ssh->exec('sudo useradd ' . @Domain::first()->watermark . '-' . $request->username . ' -m -s /bin/false');
      		$ssh->exec('echo ' . @Domain::first()->watermark . '-' . $request->username . ':' . $request->password . ' | chpasswd');

      		VPN::create([
      			'account_name' => @Domain::first()->watermark . '-' . $request->username,
      			'account_password' => $request->password,
      			'account_server' => $server->server_ip,
      			'account_create' => \Carbon\Carbon::now(),
      			'account_expired' => \Carbon\Carbon::now()->addDays($server->server_account_expired),
      			'account_status' => true,
      		]);

      		return response()->json([
      			'status' => 'success',
      			'result' => [
      				'username' => @Domain::first()->watermark . '-' . $request->username,
      				'password' => $request->password,
      				'created' => date('d-m-Y'),
      				'expired' => \Carbon\Carbon::now()->addDays($server->server_account_expired)->diffForHumans(),
      				'ip' => $server->server_ip,
      				'host' => $server->server_host,
      			],
      			'message' => 'VPN Account created successfully!'
      		]);
        }

        return response()->json([
      		'status' => 'exists',
      		'message' => 'VPN Account is already exists!'
      	]);
    	}

    	return response()->json([
    		'status' => 'exists',
    		'message' => 'VPN Account is already exists!'
    	]);
    }

    public function DNSCreator()
    {
        $server = DNSM::get();
        return view('host-to-ip')->with('servers', $server);
    }

    public function hostToIp()
    {
        return view('host-to-ip');
    }

    public function hostToIpCheck(Request $request)
    {
        $ip = gethostbyname($request->hostname);

        return response()->json([
            'result' => [
                'ip' => $ip,
                'host' => $request->hostname,
            ],
        ]);
    }

    public function portOpenCheck(Request $request)
    {

        try {
            $result = fsockopen($request->ip,$request->port);
        } catch (\ErrorException $e) {
            return response()->json([
                'status' => 'error',
                'result' => [
                    'ip' => $request->ip,
                    'port' => $request->port
                ],
            ]);
        }


        return response()->json([
                'status' => 'success',
                'result' => [
                    'ip' => $request->ip,
                    'port' => $request->port
                ],
            ]);
    }

    public function dnsCheck()
    {
        $dns = DNSM::get();

        return view('dns-creator')->with('servers', $dns);
    }

    public function dnsAdd(Request $request)
    {
        $dns = DNSM::where('domain_domain', $request->domain)->first();
        if(!$dns)
        {
            return response()->json([
                'status' => 'error',
                'messge' => 'DNS Not exists'
            ]);
        }

        $domain   = DNS::where('dns_domain', $request->hostname)->where('dns_target', $request->domain)->first();
        if(!$domain)
        {
            //create
            $cf_email = Domain::first()->cloudflare_email_address;
            $cf_api   = Domain::first()->cloudflare_api_key;

            /**
            * Get Zone ID First.
            */

            $header = [
                'X-Auth-Key: ' . $cf_api,
                'X-Auth-Email: ' . $cf_email,
                'Content-Type: application/json'
            ];

            $objects = $this->curl($header,'get','https://api.cloudflare.com/client/v4/zones?name=' . $request->domain,'');

            if($objects->result != "")
            {
                $id   = $objects->result[0]->id;
                /**
                 * Create Record
                 */
                $data = [
                    'type' => 'A',
                    'name' => $request->hostname,
                    'content' => $request->ip,
                    'ttl' => 120,
                    'proxied' => false,

                ];

                $post = $this->curl($header,'post','https://api.cloudflare.com/client/v4/zones/' . $id . '/dns_records',$data);

                @$dns_id = $post->result->id;

                if(!$dns_id)
                {
                   return response()->json([
                        'status' => 'error',
                        'message' => 'DNS Already Exists'
                    ]);
                }

                DNS::create([
                    'dns_cf_id' => $dns_id,
                    'dns_domain' => $request->hostname,
                    'dns_ip' => $request->ip,
                    'dns_target' => $request->domain
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'DNS Created Successfully',
                    'data' => [
                        'hostname' => $request->hostname,
                        'ip' => $request->ip,
                        'domain' => $request->domain,
                    ],
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Hostname is not exists'
                ]);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'DNS Record already exists!'
        ]);

    }

    public function curl($header = array(), $method = 'get', $url, $data = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        if($method == 'post')
        {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        $result = curl_exec($ch);

        return json_decode($result);
    }

    public function configList()
    {
        $config = Config::get();

        return view('config-list')->with('configs', $config);
    }

    public function sshChecker()
    {
        $server = Server::get();

        return view('ssh-checker')->with('servers', $server)->with('wm', Domain::first()->watermark);
    }

    public function postSshChecker(Request $request)
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

        if(strlen($request->username) <  11)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'SSH Username not exists!',
                'data' => [
                    'username' => $request->username,
                    'server' => $request->server_host,
                ],
            ]);
        }

        $result = $ssh->exec('sed "s/:.*//" /etc/passwd | grep ' . $request->username);

        if($result != $request->username . "\n")
        {
            return response()->json([
                'status' => 'error',
                'message' => 'SSH Username not exists!',
                'data' => [
                    'username' => $request->username,
                    'server' => $request->server_host,
                ],
            ]);
        }

        return response()->json([
                'status' => 'exists',
                'message' => 'SSH Username exists!',
                'data' => [
                    'username' => $request->username,
                    'server' => $request->server_host,
                ],
        ]);
    }

    public function squid()
    {
        $squid = Squid::get();

        return view('squid-proxy')->with('squids',$squid);
    }

    public function runCrons()
    {
        $now = \Carbon\Carbon::now();
        $expiredSSH = SSH::where('account_expired',$now)->get();
        $expiredVPN = VPN::where('account_expired',$now)->get();

        if($expiredSSH->count() < 1)
        {
          echo "No SSH Account Expired today! <br />";
        }
        else
        {
          // delete all account
          foreach($expiredSSH as $sexpire)
          {
              $server = Server::where('server_ip', $sexpire->account_server)->first();
              $ssh = new Net\SSH2($server->server_ip);
              if(!$ssh->login($server->server_user,$server->server_password))
              {
                echo "Can't connect to server!";
              }

              $ssh->exec('userdel ' . $sexpire->account_name);
              echo $sexpire->account_name . ' deleted!';
          }
        }

        if($expiredVPN->count() < 1)
        {
          echo "NO VPN Account Expired Today!<br />";
        }
        else
        {
          // delete all account
          foreach($expiredVPN as $vexpire)
          {
            $server = Server::where('server_ip', $vexpire->account_server)->first();
            $ssh = new Net\SSH2($server->server_ip);
            if(!$ssh->login($server->server_user,$server->server_password))
            {
              echo "Can't connect to server!";
            }

            $ssh->exec('userdel ' . $vexpire->account_name);
            echo $vexpire->account_name . ' deleted!';
          }
        }

    }
}
