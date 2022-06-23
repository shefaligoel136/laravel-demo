<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->logRequest($request);
        $response = $next($request);
        $this->logResponse($request,$response);
        return $response;
    }

    protected function logRequest($request)
    {
        $log = [
            'URL' => $request->getUri(),
            'METHOD' => $request->getMethod(),
            'IP' => $request->getClientIp(),
            'BODY' => $request->all(),
        ];

        Log::info(json_encode($log));
    }

    protected function logResponse($request,$response)
    {
        $log = [
            'URL' => $request->getUri(),
            'METHOD' => $request->getMethod(),
            'IP' => $request->getClientIp(),
            'BODY' => $request->all(),
            'RESPONSE' => $response->getContent(),
            'STATUS ' => $response->status(),
        ];

        if($response->status()>400){
            Log::error(json_encode($log));
        }else{
            Log::info(json_encode($log));
        }
    }

}
