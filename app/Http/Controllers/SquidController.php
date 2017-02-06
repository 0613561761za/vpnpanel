<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Squid;

class SquidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $squid = Squid::get();

        return view('admin.squid-list')->with('squids', $squid);
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
        $squid = Squid::where('squid_ip', $request->squid_ip)->where('squid_port', $request->squid_port)->first();
        if(!$squid)
        {
            Squid::create([
                'squid_ip' => $request->squid_ip,
                'squid_port' => $request->squid_port,
                'status' => true,
            ]);

            return;
        }

        return abort(503);
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
        $squid = Squid::where('squid_id', $id)->first();

        if(!$squid)
        {
            return abort(503);
        }

        return Squid::where('squid_id', $id)->delete();
    }
}
