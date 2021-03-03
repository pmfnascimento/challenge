<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class DriverLoginController extends Controller
{

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/drivers/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:driver')->except('logout');
    }

    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.drivers-login');
    }

    public function guard()
    {
        return Auth::guard('driver');
    }

    /**
     * Login the driver.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::guard('driver')->attempt($request->only('email', 'password'))) {
            //Authentication passed...
            return redirect()
                ->intended(route('drivers.home'));
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorect.']
        ]);
    }

    /**
     * Logout the driver.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        //logout the driver...
        $this->guard()->logout();
        return redirect()->route('drivers.login');
    }

    /**
     * Validate the form data.
     * 
     * @param \Illuminate\Http\Request $request
     * @return 
     */
    private function validator(Request $request)
    {

        $rules = [
            'email'    => 'required|email|exists:drivers|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }

    /**
     * Redirect back after a failed login.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
        //Login failed...
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Login failed, please try again!');
    }
}
