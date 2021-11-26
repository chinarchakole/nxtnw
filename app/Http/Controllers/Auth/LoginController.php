<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:organizer')->except('logout');
    }


    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
      
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function showOrganizerLoginForm()
    {
        return view('auth.login', ['url' => 'organizer']);
    }

    public function organizerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('organizer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/organizer');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function redirectTo() {

        
        // dd(Auth::guard());
        // dd(Auth::guard('admin')->check());
        // dd(Auth::guard('organizer')->check());
        // dd(Auth::guard('web')->check());
        // $user = Auth::user();
        // if($user){
        //         if(Auth::guard('organizer')->check() & !Auth::guard('admin')->check() &!Auth::guard('web')->check() )
        //         {
        //             return '/organizer';
        //         }
        //         elseif(!Auth::guard('organizer')->check() & Auth::guard('admin')->check() &!Auth::guard('web')->check())
        //         {
        //             return '/admin';
        //         }
        //         else{
        //             return '/home';
        //         }
        // }
            
    }

    public function logout(Request $request)
    {
        
        
        if(Auth::guard('organizer')->check())
        {
            $path = '/login/organizer';
        }
        elseif(Auth::guard('admin')->check())
        {
            $path = '/login/admin';
        }
        else
        {
            $path = '/login';
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect($path);
    }
    
}
