<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    //กำหนดค่าลงอะไรได้บาง 
    protected $fillable = [
        'user_id',
        'department_name',    
    ];

    public function user(){
        // this คือ Table Department เชื่อมกันแบบ 1 ต่อ 1 กับ Table User ด้วย PK แลพ FK
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

