<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/dashboard';

    // check if authenticated, then redirect to dashboard
    protected function authenticated() {
        if (Auth::check()) {
            return redirect('dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_process(Request $request){ die();
        $this->validate($request, [
            'email'         => 'required{email',
            'password'      => 'required|min:4'
        ]);

        $status = User::where('email',$request->email)->first();
                

        if (\Auth::guard()->attempt($request->only(['email','password']), $request->get('remember'))){
            return redirect()->intended('/back/dashboard');
        }else{
            return back()->with('error', 'Invalid email or password');
        }
    }

    public function logout(){

        if(Auth::guard()->check()){ // this means that the userwas logged in.
            Auth::guard()->logout();
        }

        $this->guard()->logout();

        return redirect('/login');
    }

}
