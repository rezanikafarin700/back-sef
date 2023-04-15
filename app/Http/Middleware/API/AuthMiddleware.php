<?php

namespace App\Http\Middleware\API;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function getTokenUser($header)
    {
//        $token = null;
//        if(Str::startsWith($header,'Bearer ')) {
//            $token = substr($header, 7);
//        }

        $token = Str::startsWith($header,'Bearer ') ? substr($header, 7) : null;
        return $token;

    }
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Authorization');
        $token = $this->getTokenUser($header);
        $user = $token ? User::where('api_token', $token)->first() : null;
        return $user ? $next($request) :  response(['message' => 'Unauthenticated'],401);

//        $header = $request->header('Authorization');
//        $token = $this->getTokenUser($header);
//        $user = null;
//        if($token) {
//            $user = User::where('api_token', $token)->first();
//        }

//        if($user) {
//            return $next($request);
//        }
//        else{
//            return response(['message' => 'Unauthenticated'],401);
//        }
    }
}
