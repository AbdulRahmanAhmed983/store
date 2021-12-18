<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
    
use Auth;
class CustomAuthController extends Controller
{
    public function Adualt(){
        return view('customAuth.index');

    }   public function site(){
        return view('site');
    }
    public function adminPanel(){
        return view('adminPanel');

    }
    public function adminLogin(){
        return view('auth.adminLogin');
    }
    public function checkadmin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/adminPanel');
        }
        return back()->withInput($request->only('email'));
    }
}

