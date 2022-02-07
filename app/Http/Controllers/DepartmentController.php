<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        ]);
    }
}
