<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        // Get Value type Eloquent
        // $departments = Department::all();

        // นำข้อมูลมา Show ตามจำนวนที่ตั่งค่า 
        $departments=Department::paginate(3);

        // Get Value type Query Builder 
        // $departments=DB::table('departments')->get();

        // นำข้อมูลมา Show ตามจำนวนที่ตั่งค่า แบบ Query Builder 
        // $departments=DB::table('departments')->paginate(3);
        return view('admin.department.index', compact('departments')); 
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
            'department_name.max'=>"ห้ามป้อนเกิน 25 ตัวอักษร",
            'department_name.unique'=>"มีข้อมูลนี้ในฐานข้อมูลแล้ว"
        ]
        );
        //บันทึกข้อมูล แบบ Eloquent
        $department = new Department;
        // Column Name = Value From View(index)
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id; 
        $department->save();

        // //บันทึกข้อมูล แบบ Query Builder ไม่ต้องใช้ model
        // $data = array();
        // $data["department_name"] = $request->department_name;
        // $data["user_id"] = Auth::user()->id;
        // DB::table('departments')->insert($data);

        return redirect()->back()->with('Success', "บันทึกข้อมูลเรียบร้อย");
    }
}
