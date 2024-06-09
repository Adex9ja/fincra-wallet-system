<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function index()
    {
        if(Auth::check())
            return redirect()->intended('dashboard');
        else
            return view('index');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->with([
            'msg' => $this->prepareMessage(false, "The provided credentials do not match our records."),
        ]);
    }
    public function dashboard(){
        $data = $this->mproxy->getDashBoardReportData();
        $insight =$this->mproxy->getWeeklyReport();
        return view('dashboard', ['data' => $data, 'sales' => $insight]);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function users()
    {
        $users = $this->mproxy->getAllUsers();
        return view('user_list', ['data' => $users]);
    }

    public function user($id){
        $user = $this->mproxy->getUser($id);
        return view('user_detail', ['data' => $user]);
    }

    public function generateToken(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }
    private function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
