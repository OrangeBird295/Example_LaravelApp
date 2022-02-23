<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(){
 
        // นำข้อมูลมา Show ตามจำนวนที่ตั่งค่า 
        $services=Service::paginate(3);
        return view('admin.service.index', compact('services')); 
    }

    public function store(Request $request){

        // Check Value
        $request->validate([
            //Not Null AND Unique:table AND Max length
            'service_name'=>'required|unique:services|max:25',
            'service_image'=>'required|mimes:jpg,jpeg,png'
        ],
        [
            'service_name.required'=>"กรุณาป้อนชื่อบริการด้วยครับ",
            'service_name.max'=>"ห้ามป้อนเกิน 25 ตัวอักษร",
            'service_name.unique'=>"มีข้อมูลนี้ในฐานข้อมูลแล้ว",
            'service_image.required'=>"กรุณาใส่ภาพประกอบ"
        ]
        );
        // dd($request->service_name, $request->service_image);
        //การเข้ารหัสรูปภาพ
        $service_image = $request->file('service_image');
        // //Generate ชื่อภาพ
        $name_gen = hexdec(uniqid()); 
        // //ดึงนามสกุลรูปภาพ
        $img_ext = strtolower($service_image->getClientOriginalExtension());
        // //รวมชื่อและนามสกุล(ต่อ string ใน php ใช้เครื่องหมาย ".")
        $img_name = $name_gen.'.'.$img_ext;
        dd($img_name);
        
    }
}
