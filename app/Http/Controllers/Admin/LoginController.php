<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//         $this->middleware('guest:admin');
    }

    /**
     * 認証カラム変更 email→admin_id
     *
     */

    public function username()
    {
        return 'admin_id';
    }


    public function showLoginForm() {
        return view('admin.login');
    }

    /**
     * 管理ログイン処理
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request) {
        $this->validate($request, [
            'admin_id' => 'required',
            'password' => 'required|min:4'
        ]);

        if (Auth::guard('admin')->attempt([
            'admin_id' => $request->admin_id,
            'password' => $request->password
        ], $request->remember)) {
            return redirect()->intended('admin.home');
        } else {
            return redirect()->back()->withInput($request->only('admin_id', 'remember'));
        }
    }

    /**
     * 管理ログアウト処理
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}
