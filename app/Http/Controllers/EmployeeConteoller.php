<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EmployeeConteoller extends Controller
{
    public function index(){
        $employees = Employee::orderBy('id','ASC')->paginate(5);
        return view('employee.list', ['employees' => $employees]);
    }
    public function create(){
        return view('employee.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg'
        ]);
        if($validator->passes()){
            // save data here
            $employee = new Employee();
            $employee->name =$request->name;
            $employee->email =$request->email;
            $employee->address =$request->address;
            $employee->save();

            // Upload image
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName);
                $employee->image = $newFileName;
                $employee->save();
            }

            return redirect()->route('employees.index')->with('success','Employee added Successfully !');
        }else{
            // return wiht errors
            return redirect()->route('employees.create')->withErrors($validator)->withInput();
        }
    }
    public function edit($id){
        $employee = Employee::findOrFail($id);
        return view('employee.edit',['employee' => $employee]);
    }
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,png,jpeg,jpg'
        ]);
        if($validator->passes()){
            // save data here
            $employee = Employee::find($id);
            $employee->name =$request->name;
            $employee->email =$request->email;
            $employee->address =$request->address;
            $employee->save();

            // Edit & Update image
            if($request->image){
                $oldImage = $employee->image;

                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/employees/',$newFileName);
                $employee->image = $newFileName;
                $employee->save();

                // delete ภาพเก่าเมื่อมีการ Update ภาพใหม่
                // import class :  use Illuminate\Support\Facades\File;
                File::delete(public_path().'/uploads/employees/'.$oldImage);
            }

            return redirect()->route('employee.index')->with('success','Employee Updated Successfully !');
        }else{
            // return wiht errors
            return redirect()->route('employees.edit', $id)->withErrors($validator)->withInput();
        }
    }
    public function destroy($id, Request $request){
        $employee = Employee::findOrFail($id);
        File::delete(public_path().'/uploads/employees/'.$employee->image);
        $employee->delete();
        return redirect()->route('employee.index')->with('success','Employee Deleted Successfully !');
    }
}
