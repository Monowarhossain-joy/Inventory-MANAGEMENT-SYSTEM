<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Admin;
use App\Models\Manager;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\Salary_history;
use Carbon\Carbon;
class InventoryAPIController extends Controller
{
    //
    public function list(){
        $users = Users::all();
        return $users;
    }
    public function employeeList(){
        $employees = Employee::all();
        return $employees;
    }
    public function salarylist(){
        $salarys = Salary::all();
        return $salarys;

    }
    public function delete(Request $request)
    {
        $id = $request->id;
        Employee::where('e_id',$request->id)->delete();
        $employee =Employee::all();
        return $employee ;

    }
    public function Userdelete(Request $request)
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
        $users =Users::all();
        return $users;

    }
    public function login(Request $request){
        return $request;
        $user = Users::where('phone',$request->phone)->first();
        if($user){
            if($request->password === $user->password)
            {
                if($user->usertype == 'admin')
                {
                    return $user;
                }
                else
                {
                    $obj = array('fail'=>'manager Panel is under Construction...');
                    return (object)$obj;
                }
            }
            else{
                $obj = array('fail'=>'Incorrect password');
                return (object)$obj;
            }
        }
        else{
            $obj = array('fail'=>'user does not exist');
                return (object)$obj;
        }
       
    }
    public function logout(Request $request)

    {

        $date=Carbon::now();
        $token = Tokens::where('id',$request->id)->first();
        $token->expired_at =$date->toDateTimeString();
        $token->save();
        return 'token expired';

    }
    public function employeeView(Request $request)
    {
        $id = $request->id;
        $employee = Employee::where('e_id',$id)->first();
        return $employee;
        
    }
    public function view(Request $request)
    {
        
        $id = $request->id;
        $user = Users::where('u_id',$id)->first();
        if($user->usertype == 'admin')
        {
            $admin = Admin::where('u_id',$id)->first();
            return $admin;
        }
        else
        {
            $manager = Manager::where('u_id',$id)->first();
            return $manager;
        }
    }
    public function EeditSubmit(Request $request){
            $id = $request->e_id;
            $employee = Employee::where('e_id',$id)->first();
            $employee->name = $request->name;
            $employee->dob = $request->dob;
            $employee->address = $request->address;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->save();

        return 'done';

    }
    public function editSubmit(Request $request){
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

        return 'done';

    }

    public function createSubmit(Request $request)
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
        

        $var = new Users;
        $var->u_id = $id;
        $var->name = $request->name;
        $var->phone = $request->phone;
        $var->password = $request->password;
        $var->usertype = $request->usertype;
        $var->save();

        if($request->usertype=='admin')
            {
                $var1 = new Admin;
                $var1->u_id = $id;
                $var1->name = $request->name;
                $var1->dob = $request->dob;
                $var1->address = $request->address;
                $var1->email = $request->email;
                $var1->phone = $request->phone;
                $var1->password = $request->password;
       
                $var1->save();
            }
        

                if($request->usertype=='manager')
                {
                $var2 = new Manager;
                $var2->u_id = $id;
                $var2->name = $request->name;
                $var2->dob = $request->dob;
                $var2->address = $request->address;
                $var2->email = $request->email;
                $var2->phone = $request->phone;
                $var2->password = $request->password;
                $var2->save();
    }


        return 'succesfull';
    }
    public function ecreateSubmit(Request $request)
    {

        $employees = Employee::all();

    

            if($employees->isEmpty())

            {

                $id = 1;

            }

            else

            {
                $employees= Employee::OrderBy('e_id','DESC')->first();

                $id = $employees->e_id + 1;
            }
        

            $var1 = new Employee;
            $var1->e_id = $id;
            $var1->name = $request->name;
            $var1->dob = $request->dob;
            $var1->address = $request->address;
            $var1->email = $request->email;
            $var1->phone = $request->phone;
            $var1->password = $request->password;
            $var1->save();

        return 'succesfull';
    }
    public function salary(Request $request)
    {
    
        $employee = Employee::all();
        foreach($employee as $e)

        {

            $id = $e->e_id;
            if($request->$id > 0)

            {
               $salary = Salary::where('s_id',$id)->first();
               if($salary)
               {
                $timestamp = strtotime($salary->updated_at);
                $month = date('M', $timestamp);
                $cdate = Carbon::now();
                $ctimestamp = strtotime($cdate);
                $cmonth = date('M', $ctimestamp);
               
 
                if($month != $cmonth)
                {
                    
                    $salary = Salary::where('s_id',$id)->first();
                    $salary->salary = $request->$id;
                    $salary->save();

                    // $salary = new Salary;
                    // $employee = Employee::where('e_id',$id)->first();
                    // $salary->salary = $request->$id;
                    // $salary->s_id= $employee->e_id;
                    // $salary->name= $employee->name;
                    // $salary->phone= $employee->phone;
                    // $salary->save();


                    $salary_history = new Salary_history;
                    $employee = Employee::where('e_id',$id)->first();
                    $salary_history->salary = $request->$id;
                    $salary_history->s_id= $employee->e_id;
                    $salary_history->name= $employee->name;
                    $salary_history->phone= $employee->phone;
                    $salary_history->save();
 
                }

               }
               else
               {

                    $salary = new Salary;
                    $employee = Employee::where('e_id',$id)->first();
                    $salary->salary = $request->$id;
                    $salary->s_id= $employee->e_id;
                    $salary->name= $employee->name;
                    $salary->phone= $employee->phone;
                    $salary->save();

                    $salary_history = new Salary_history;
                    $employee = Employee::where('e_id',$id)->first();
                    $salary_history->salary = $request->$id;
                    $salary_history->s_id= $employee->e_id;
                    $salary_history->name= $employee->name;
                    $salary_history->phone= $employee->phone;
                    $salary_history->save();
               }
               
            }

        }
        return 'done';
    }
    
}
