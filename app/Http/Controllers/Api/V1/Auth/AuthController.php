<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * USER REGISTRATION
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ]);

        $user = new User([
            'firstName' => $request->firstName,
            'middleName' => !empty($request->middleName) ? $request->middleName : '',
            'lastName' => $request->lastName,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        $token_result = $user->createToken('Personal Access Token');
        $token = $token_result->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return response()->json([
            'token' => $token_result->accessToken,
            'expires_at' => Carbon::parse( $token_result->token->expires_at)->toDateTimeString(),
            'isError' => FALSE,], 200);

    }

    /**
     * USER LOGIN
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'User credentials are not correct',
                'isError' => TRUE,], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return response()->json([
            'token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse( $tokenResult->token->expires_at)->toDateTimeString(),
            'isError' => FALSE,], 200);
    }


    /**
     * USER LOGOUT
     */
    public function logout(Request $request)
    {
        $request->user()->token()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }


    /**
     *AUTHENTICATION USER PROFILE
     */
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
}
