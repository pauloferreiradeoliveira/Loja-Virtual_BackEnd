<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Funcionario;
use Illuminate\Support\Facades\Hash;


class AuthAdminController extends Controller
{
    public function login()
    {
       $creteincial = request(['name','password']);

       // return response()->json(Hash::make($creteincial['password']));
        //return request();
        if (! $token = auth()->guard('admin')->attempt($creteincial)) {
            return response()->json(['error' => 'Sem Autorização'], 401);
        }

        return response()->json(['token' => $this->respondWithToken($token)->original, 'usuario' => auth('admin')->user()]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Deslogado Com Sucesso']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('admin')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ]);
    }
}
