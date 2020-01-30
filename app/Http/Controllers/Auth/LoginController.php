<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

  public function login(Request $request)
  {
    // dd($request->all());
    $this->validateLogin($request);
    
    if($this->attemptLogin($request)) {
      $user = $this->guard()->user();
      $user->generateToken();
      $user->roles = $user->roles;
      $user->companies = $user->companies;
      $user->products = $user->products;
      $user->sub_product = $user->sub_product;
      return response()->json([
          'data'    =>  $user->toArray(),
          'message' =>  "User is Logged in Successfully",
          'token'   =>  $user->api_token,
          'success' =>  true
      ]);
    }
    else {
      $this->sendFailedLoginResponse($request);
    }
  }

}
