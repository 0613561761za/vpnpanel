<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\DNS;
use App\DNSM;
use App\Domain;

class DNSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dns = DNS::get();

        return view('admin.dns-list')->with('dnss', $dns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dns = DNSM::where('domain_domain', $request->dnsdomain)->first();

        if(!$dns)
        {
            //create
            DNSM::create([
                'domain_name' => $request->dnsname,
                'domain_domain' => $request->dnsdomain,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'DNS Created successfully!',
            ]);
        }

        return response()->json([
            'status' => 'exists',
            'message' => 'DNS Already exists'
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
        $dns = DNS::where('dns_id', $id)->first();

        if(!$dns)
        {
            return abort(503);
        }

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

        $objects = $this->curl($header,'get','https://api.cloudflare.com/client/v4/zones?name=' . $dns->dns_target,'');

        if($objects->result != "")
        {
            $id   = $objects->result[0]->id;
            
            $r = $this->curl($header,'delete','https://api.cloudflare.com/client/v4/zones/' . $id . '/dns_records/' . $dns->dns_cf_id,'');
            if($r->success)
            {
                return DNS::where('dns_id',$dns->dns_id)->delete();
            }
            
            return abort(503);
        }



    }

    public function curl($header = array(), $method = 'get', $url, $data = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        if($method == 'delete')
        {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }
        if($method == 'post')
        {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        $result = curl_exec($ch);

        return json_decode($result);
    }
}
