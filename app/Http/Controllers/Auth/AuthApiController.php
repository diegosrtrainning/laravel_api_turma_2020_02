<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthApiController extends Controller
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return $this->responseToken($token);
    }

    private function responseToken($token)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $expires = \Auth::guard('api')->factory()->getTTL() * 60;
        $date = date_create(date('Y-m-d H:i:s')); //create a date/time variable (with the specified format - create your format, see (1))
        date_add($date, date_interval_create_from_date_string($expires.' seconds')); //add dynamic quantity of seconds to data/time variable

        if($token){
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expira_em' => date_format($date, 'd/m/Y H:i:s')
            ]);
        }else{
            return response()->json([
                'error' => \Lang::get('auth.failed')
            ], 400);
        }
    }

    public function logout()
    {
        try {
            \Auth::guard('api')->logout(true);
            return response()->json([], 204); //No-content
        } catch (JWTException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function refresh()
    {
        try {
            $token = \Auth::guard('api')->refresh();
            return $this->responseToken($token);
        } catch (JWTException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }
    }

    public function me()
    {
        try {
            return response()->json(\Auth::guard('api')->user());
        } catch (JWTException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
