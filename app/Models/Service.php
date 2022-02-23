<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    //กำหนดค่าลงอะไรได้บาง 
    protected $fillable = [
        'service_name',
        'service_image',    
    ];
}
