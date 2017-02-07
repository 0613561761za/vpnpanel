<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\Ads;
use App\Group;

class EditController extends Controller
{
    public function ads($id)
    {
        $ads = Ads::where('ads_id', $id)->first();

        if(!$ads)
        {
          return abort(404);
        }

        return view('admin.ads-edit')->with('ads', $ads);
    }

    public function postAds(Request $request,$id)
    {
        $ads = Ads::where('ads_id',$id)->first();

        if(!$ads)
        {
          return abort(404);
        }

        Ads::where('ads_id', $id)->update([
          'ads_name' => $request->adsname,
          'ads_type' => $request->adstype,
          'ads_body' => $request->adscode,
        ]);

        return;
    }

    public function ssh($id)
    {
        $ssh = Server::where('server_id', $id)->where('server_type','ssh')->first();
        $group = Group::get();
        if(!$ssh)
        {
            return abort(404);
        }

        return view('admin.ssh-server-edit')->with('server', $ssh)->with('groups', $group);
    }

    public function postSSH(Request $request, $id)
    {
        $server = Server::where('server_id', $id)->where('server_type', 'ssh')->first();

        if(!$server)
        {
          return abort(404);
        }

        $limit = $server->server_is_limit;

        Server::where('server_id', $id)->where('server_type', 'vpn')->update([
          'server_name' => $request->servername,
          'server_ip' => $request->serverip,
          'server_host' => $request->serverhost,
          'server_user' => $request->serveruser,
          'server_password' => $request->serverpassword,
          'server_country' => $request->servercountry,
          'server_port' => $request->serverport,
          'server_limit' => $request->serverlimit,
          'server_type' => 'ssh',
          'server_is_limit' => $limit,
          'server_group' => $request->servergroup,
          'server_account_expired' => $request->serverexpired,
        ]);

        return;
    }

    public function group($id)
    {
        $group = Group::where('group_id', $id)->first();

        if(!$group)
        {
          return abort(404);
        }

        return view('admin.group-edit')->with('group', $group);
    }

    public function postGroup(Request $request,$id)
    {
        $group = Group::where('group_id', $id)->first();

        if(!$group)
        {
          return abort(404);
        }

        if(!preg_match("/\|/", $request->grouplist))
        {
            $grouplist = "|" . $request->grouplist;
        }
        else
        {
            $grouplist = $request->grouplist;
        }

        Group::where('group_id', $id)->update([
            'group_name' => $request->groupname,
            'group_country' => $request->groupcountry,
            'group_country_list' => $grouplist,
            'group_count' => 0,
        ]);

        return;
    }

    public function squid($id)
    {
        $squid = Squid::where('squid_id', $id)->first();

        if(!$squid)
        {
          return abort(404);
        }

        return view('admin.squid-edit')->with('squid', $squid);
    }

    public function vpn($id)
    {
       $group = Group::get();

       $server = Server::where('server_id', $id)->where('server_type', 'vpn')->first();
       if(!$server)
       {
          return abort(404);
       }

       return view('admin.vpn-edit')->with('server', $server)->with('groups', $group);
    }

    public function postVPN(Request $request,$id)
    {
        $server = Server::where('server_id', $id)->where('server_type', 'vpn')->first();

        if(!$server)
        {
          return abort(404);
        }

        $limit = $server->server_is_limit;

        Server::where('server_id', $id)->where('server_type', 'vpn')->update([
            'server_name' => $request->servername,
            'server_ip' => $request->serverip,
            'server_host' => $request->serverhost,
            'server_user' => $request->serveruser,
            'server_password' => $request->serverpassword,
            'server_country' => $request->servercountry,
            'server_protocol' => $request->serverproto,
            'server_port' => $request->serverport,
            'server_limit' => $request->serverlimit,
            'server_type' => 'vpn',
            'server_is_limit' => $limit,
            'server_group' => $request->servergroup,
            'server_account_expired' => $request->serverexpired,
        ]);

        return;
    }

}
