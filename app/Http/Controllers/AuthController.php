<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\Http\Requests\LoginRequest;
// Models
use App\User;
use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Register
     * 
     * @param string email
     * @param string name
     * @param string password
     * 
     * @return json 
     */
    public function register(RegisterUser $request)
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password)
        ]);

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return abort(404);
        }

        return response()->json([
            'data' => new UserResource($user),
            'meta' => $this->tokenResponse($token)
        ]);
    }

    /**
     * Login 
     * 
     * @param string email
     * @param string password
     * 
     * @return json
     */
    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return abort(404);
        }

        return response()->json([
            'data' => new UserResource(auth()->user()),
            'meta' => $this->tokenResponse($token)
        ]);
    }

    /**
     * Logout
     * 
     * @return json
     */
    public function logout()
    {
        auth()->logout();

        return response()->json('Logged Out');
    }

    /**
     * User 
     * 
     * @return json
     */
    public function user(Request $request)
    {
        return response()->json([
            'data' => new UserResource(auth()->user())
        ]);
    }

    /**
     * Token Response
     * 
     * @param string $token
     * 
     * @return array
     */
    protected function tokenResponse($token)
    {
        return [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ];
    }

}
