<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index(){
        return view('admin.department.index'); 
    }
    public function store(Request $request){
        // debug
        // dd($request->department_name);

        // Check Value
        $request->validate([
            //Not Null AND Unique:table AND Max length
            'department_name'=>'required|unique:departments|max:25'
        ],
        [
            'department_name.required'=>"กรุณาป้อนชื่อแผนกด้วยครับ",
            'department_name.max'=>"ห้ามป้อนเกิน 25 ตัวอักษร"
        ]
        );
        //บันทึกข้อมูล
        $department = new Department;
        // Colimn Name = Value From View(index)
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id; 
        $department->save();
        return redirect()->back()->with('Success', "บันทึกข้อมูลเรียบร้อย");
    }
}
