<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Admin;
use App\Models\Manager;


class UserController extends Controller
{
    public function create()
    {
        $users = Users::all();

            if($users->isEmpty())

            {

                $id = 1;

            }

            else

            {

                $users= Users::OrderBy('u_id','DESC')->first();

                $id = $users->u_id + 1;

            }
        return view('Pages.Users.create') ->with("id",$id);
    }

    

    public function createSubmit(Request $request)
    {

        $this->validate(
            $request,
            [
                'name'=>'required|min:3|max:30|regex:/^[A-Za-z)\s\0-9]+$/',
                'dob'=>'required',
                'address'=>'required',
                'phone'=>'required',
                'email'=>'required',
                'category'=>'required|not_in:select your option',
                'address'=>'required',
            ],
            [

                'category.not_in'=>'Please select your option'

            ]
        );
        

        $var = new Users;
        $var->u_id = $request->u_id;
        $var->name = $request->name;
        $var->phone = $request->phone;
        $var->password = $request->password;
        $var->usertype = $request->category;
        $var->save();

        if($request->category=='admin')
            {
                $var1 = new Admin;
                $var1->u_id = $request->u_id;
                $var1->name = $request->name;
                $var1->dob = $request->dob;
                $var1->address = $request->address;
                $var1->email = $request->email;
                $var1->phone = $request->phone;
                $var1->password = $request->password;
                
                $var1->save();
            }
        

        if($request->category=='manager')
        {
        $var2 = new Manager;
        $var2->u_id = $request->u_id;
        $var2->name = $request->name;
        $var2->dob = $request->dob;
        $var2->address = $request->address;
        $var2->email = $request->email;
        $var2->phone = $request->phone;
        $var2->password = $request->password;
        $var2->save();
    }


        return redirect()->route('user/list');
    }

    public function list(){
        $users = Users::all();
        return view('Pages.Users.list')->with('users',$users);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $user = Users::where('u_id',$id)->first();
        if($user->usertype == 'admin')
        {
            $user = Admin::where('u_id',$id)->first();
        }
        else
        {
            $user = Manager::where('u_id',$id)->first();
        }

        return view('Pages.Users.edit')->with('user',$user);

    }

    public function editSubmit(Request $request){
        $this->validate(
            $request,
            [
                'name'=>'required|max:30|regex:/^[A-Za-z)\s\0-9]+$/',
                'address'=>'required|max:30',
                'email'=>'required',
            ]
        );

        $id = $request->u_id;
        $user = Users::where('u_id',$id)->first();
        if($user->usertype == 'admin')
        {
            $user = Users::where('u_id',$id)->first();
            $user->name = $request->name;
            $user->save();

            $admin = Admin::where('u_id',$id)->first();
            $admin->name = $request->name;
            $admin->dob = $request->dob;
            $admin->address = $request->address;
            $admin->email = $request->email;
            $admin->save();
        }
        else
        {
            $user = Users::where('u_id',$id)->first();
            $user->name = $request->name;
            $user->save();

            $manager = Manager::where('u_id',$id)->first();
            $manager->name = $request->name;
            $manager->dob = $request->dob;
            $manager->address = $request->address;
            $manager->email = $request->email;
            $manager->save();
        }

        return redirect()->route('user/list');

    }
    public function view(Request $request)
    {
        $id = $request->id;
        $user = Users::where('u_id',$id)->first();
        if($user->usertype == 'admin')
        {
            $admin = Admin::where('u_id',$id)->first();
            return view('Pages.Users.view')->with('user',$admin);
        }
        else
        {
            $manager = Manager::where('u_id',$id)->first();
            return view('Pages.Users.view')->with('user',$manager);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $user = Users::where('u_id',$id)->first();
        if($user->usertype == 'admin')
        {
            Admin::where('u_id',$request->id)->delete();
        }
        else
        {
            Manager::where('u_id',$request->id)->delete();
        }

        Users::where('u_id',$request->id)->delete();
        return back();

    }
    
}
