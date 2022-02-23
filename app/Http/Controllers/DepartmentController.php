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
        // ข้อมูลจากถังขยะ
        $trashDepartments=Department::onlyTrashed()->paginate(3);
        
        // Get Value type Query Builder 
        // $departments=DB::table('departments')->get();

        // นำข้อมูลมา Show ตามจำนวนที่ตั่งค่า แบบ Query Builder 
        // $departments=DB::table('departments')->paginate(3);

        //Join Table department & users & select value in table
        // $departments=DB::table('departments')
        // ->join('users', 'departments.user_id', 'users.id')
        // ->select('departments.*', 'users.name')->paginate(3);

        return view('admin.department.index', compact('departments', 'trashDepartments')); 
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

    public function edit($id){
        // dd($id);
        $department = Department::find($id);
        // dd($department->department_name);
        return view('admin.department.edit', compact('department'));
    }

    public function update(Request $request, $id){
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
        // find(PK)
        $update = Department::find($id)->update([
            'department_name'=>$request->department_name,
            'user_id'=>Auth::user()->id
        ]);

        return redirect()->route('department')->with('Success', "อัพเดตข้อมูลเรียบร้อย");
    }

    //ไม่ได้ลบถาวรแต่จะไปอยู่ในถังขยะ
    public function sofedelete($id){
        $delete = Department::find($id)->delete();
        return redirect()->back()->with('Success', "ลบข้อมูลเรียบร้อย");
    }

    // f(x) กู้คืนข้อมูล
    public function restore($id){
        Department::withTrashed()->find($id)->restore();
        return redirect()->back()->with('Success', "กู้คืนข้อมูลสำเร็จ");
    }

    //ลบข้อมูลถาวร 
    public function delete($id){
        $delete = Department::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('Success', "ลบข้อมูลถาวรเรียบร้อย");
    }
}
