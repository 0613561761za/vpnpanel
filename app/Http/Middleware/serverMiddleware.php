<?php

namespace App\Http\Middleware;

use Closure;
use \App\Server;

class serverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $server = Server::where('server_id', $request->id)->first();
        if(!$server)
        {
            return abort(404);
        }
        return $next($request);
    }
}
