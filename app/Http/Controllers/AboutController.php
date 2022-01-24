<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    function index() {
        $addr = "74/89 , Thailand" ;
        $phone = "085-389-0830" ;
        $mail = "orangebird295@gmail.com";
        //send velue 
        //return view('about', ['addr'=>$addr, 'phone'=>$phone, 'mail'=>$mail]); //key -> value(Associative array)
        //function compact
        //return view('about', compact('addr', 'phone', 'mail'));
        //function with (key, value(สามารถส่งเป็น str ไปได้เลย)) , ส่วนใหญ่เอาไว้ส่งสถานะ 
        return view('about')
        ->with('addr', $addr)
        ->with('phone', $phone)
        ->with('mail', $mail);

    }
    function showData() {
        echo 'Data';
    }
}
