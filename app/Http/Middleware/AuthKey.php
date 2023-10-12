<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AppKey;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        $token = $request->header('APP-KEY');
       

        $tokenDB=AppKey::where('token',$token)->where('bloqueado',0)->first();
        if(!$tokenDB){
            return response()->json(['success'=>false,'message'=>"Sin app key"],401);
        }

        return $next($request);
    }
}
