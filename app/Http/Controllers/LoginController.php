<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Managers;
use App\Models\Users;

class LoginController extends Controller
{
    public function login(){
        return view('Pages.Users.Login');
    }

    public function loginAction(Request $request){
        $this->validate(
            $request,
            [
                'phone'=>'required',
                'password'=>'required'
            ]
        );

        $user = Users::where('phone',$request->phone)->first();
        if($user){
            if($request->password === $user->password)
            {
                if($user->usertype == 'Manager')
                {
                    $request->session()->put('user',$user->manager);
                    return redirect()->route('dashboard');
                }
                else
                {
                    $request->session()->put('user',$user->admin);
                    return redirect()->route('user/create');
                }
            }
            else{
                return back()->with('fail','Incorrect Password');
            }
        }
        else{
            return back()->with('fail','phone number does not exist');
        }
       
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('user/login');
    }
}
