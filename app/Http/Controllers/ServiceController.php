<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

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
        // dd($img_name);
        
        //Upload img
        $upload_location = 'image/services/';
        $full_path = $upload_location.$img_name;
        Service::insert([

            'service_name'=>$request->service_name,
            'service_image'=>$full_path,
            'created_at'=>Carbon::now()
        ]);
        $service_image->move($upload_location,$img_name);
        return redirect()->back()->with('Success', "บันทึกข้อมูลเรียบร้อย");
    }

    public function edit($id){
        // dd($id);
        $service = Service::find($id);
        // dd($department->department_name);
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id){
        // Check Value
        $request->validate([
            //Not Null AND Unique:table AND Max length
            'service_name'=>'required|max:25',
        ],
        [
            'service_name.max'=>"ห้ามป้อนเกิน 25 ตัวอักษร",
            'service_name.required'=>"กรุณาป้อนชื่อบริการด้วยครับ"
        ]
        );
        $service_image = $request->file('service_image');
        
        if($service_image){ 
            // //Generate ชื่อภาพ
            $name_gen = hexdec(uniqid()); 
            // //ดึงนามสกุลรูปภาพ
            $img_ext = strtolower($service_image->getClientOriginalExtension());
            // //รวมชื่อและนามสกุล(ต่อ string ใน php ใช้เครื่องหมาย ".")
            $img_name = $name_gen.'.'.$img_ext;
            // dd($img_name);
            
            //Upload img 
            $upload_location = 'image/services/';
            $full_path = $upload_location.$img_name;

            //update
            Service::find($id)->update([
                'service_name'=>$request->service_name,
                'service_image'=>$full_path,
            ]);

            //delete old img
            $old_image = $request->old_image;
            unlink($old_image);
            // dd($old_image);

            $service_image->move($upload_location,$img_name);
            return redirect()->route('services')->with('Success', "อัพเดตเรียบร้อย");
        }
        else{
            dd("มีการอัพเดตชื่อ");
        }
    }

    //ลบข้อมูลถาวร 
    public function delete($id){
        //delete img
        $img = Service::find($id)->service_image;
        unlink($img);

        //delete valur from DB 
        $delete = Service::find($id)->delete();
        return redirect()->back()->with('Success', "ลบข้อมูลเรียบร้อย");
    }
}
