<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(['username' => $request->username,
            'password' => $request->password])){
            return redirect()->route('admin.dashboard');
        }else {
           session()->flash('error', 'Credential do not matched');
           return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect('admin');
    }
}
