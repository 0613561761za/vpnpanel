<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Config;
use App\Server;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Config::get();

        return view('admin.config-list')->with('configs', $config);
    }

    public function add()
    {
        $server = Server::get();
        return view('admin.config-add')->with('servers', $server);
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

        if(!$request->hasFile('configfile'))
        {
            return abort(503);
        }


        if(Config::where('config_filename', $request->file('configfile')->getClientOriginalName())->first())
        {
            return view('admin.config-add')->with('failed', 'Config Already Uploaded!')->with('servers', Server::get());
        }

        $request->file('configfile')->move('config-file', $request->file('configfile')->getClientOriginalName());
        //$path = Storage::putFileAs('config',$request->file('configfile'),$request->file('configfile')->getClientOriginalName());

        Config::create([
            'config_name' => $request->configname,
            'config_type' => $request->configproto,
            'config_server' => $request->configserver,
            'config_filename' => $request->file('configfile')->getClientOriginalName(),
        ]);

        return view('admin.config-add')->with('success', 'Config Successfully Uploaded!')->with('servers', Server::get());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $config = Config::where('config_id', $id)->first();
        
        if(!$config)
        {
            return abort(404);
        }

        //return asset('config/' . $config->config_filename);

        //return Storage::get(public_path() . '/' . $config->config_filename);

        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

        return redirect(url('/config-file/' . $config->config_filename));
        
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
        $config = Config::where('config_id', $id)->first();
        if(!$config)
        {
            abort(503);
        }

        File::delete('config-file/' . $config->config_filename);

        return Config::where('config_id', $id)->delete();
    }
}
