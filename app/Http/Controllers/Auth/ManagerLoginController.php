<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class ManagerLoginController extends Controller
{

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/managers/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:manager')->except('logout');
    }

    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.managers-login');
    }

    public function guard()
    {
        return Auth::guard('manager');
    }

    /**
     * Login the manager.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validator($request);

        if ($this->guard()->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            //Authentication passed...
            return redirect()
                ->intended(route('managers.home'));
        }

        throw ValidationException::withMessages([
            'email' =>['The provided credentials are incorect.']
        ]);
    }

    /**
     * Logout the manager.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        //logout the manager...
        $this->guard()->logout();
        return redirect()->route('managers.login');
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
            'email'    => 'required|email|exists:managers|min:5|max:191',
            'password' => 'required|string',
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
            ->with('error', 'Login failed, please try again!');
    }
}
