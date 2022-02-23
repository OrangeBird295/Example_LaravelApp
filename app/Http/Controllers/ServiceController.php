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
}
