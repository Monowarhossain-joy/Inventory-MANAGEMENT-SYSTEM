<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Salary;

class EmployeeController extends Controller
{
    public function create()
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
        return view('Pages.Employee.create') ->with("id",$id);
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $employee = Employee::where('e_id',$id)->first();
        return view('Pages.Employee.view')->with('employee',$employee);
        
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
                'address'=>'required',
            ],
           
        );
        

            $var1 = new Employee;
            $var1->e_id = $request->e_id;
            $var1->name = $request->name;
            $var1->dob = $request->dob;
            $var1->address = $request->address;
            $var1->email = $request->email;
            $var1->phone = $request->phone;
            $var1->password = $request->password;
            $var1->save();

        return redirect()->route('employee/list');
    }

    public function list(){
        $employees = Employee::all();
        return view('Pages.Employee.list')->with('employee',$employees);
    }
    public function salary(Request $request)
    {
        $employee = Employee::all();

        foreach($employee as $e)

        {

            $id = $e->e_id;
            

            if($request->$id > 0)

            {

               $salary = new Salary;
               $employee = Employee::where('e_id',$id)->first();
               $salary->salary = $request->$id;
               $salary->s_id= $employee->e_id;
               $salary->name= $employee->name;
               $salary->phone= $employee->phone;
               $salary->save();
            }

        }
        return redirect()->route('salary/list');
    }
    public function salarylist(){
        $salarys = Salary::all();
        return view('Pages.Salary.list')->with('salarys',$salarys);     
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $employees = Employee::where('e_id',$id)->first();
        return view('Pages.Employee.edit')->with('employee',$employees);

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

        $id = $request->e_id;

            $employee = Employee::where('e_id',$id)->first();
            $employee->name = $request->name;
            $employee->dob = $request->dob;
            $employee->address = $request->address;
            $employee->email = $request->email;
            $employee->save();

        

        return redirect()->route('employee/list');

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        Employee::where('e_id',$request->id)->delete();
        return back();

    }
    
}
