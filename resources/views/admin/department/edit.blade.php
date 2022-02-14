<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello, {{Auth::user()->name}}
        
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <!-- แถวของ Bootstrap มี12ส่วน 8ส่วนให้เป็นเนื่อหาที่ไปดึงมาจากฐานข้อมูลพวกตาราง -->
                <div class="col-md-8">
                <div class="card">
                        <div class="card-header"> แบบฟอร์มแก้ไขข้อมูล </div>
                        <div class="card-body">
                            <!-- จะวิ่งไปที่ Controller(store) เมื่อกดปุ่ม -->
                            <form action="" method="post">
                                <!-- เพื่อป้องกันการ Hack ระบบรูปแบบการป้อน Scirpt -->
                                @csrf
                                <div class="form-group">
                                    <label for="department_name"> ชื่อแผนก </label>
                                    <input type="text" class="form-control" name="department_name" value="{{$department->department_name}}">
                                </div>
                                @error('department_name')
                                    <div class="my-2">
                                    <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <br>
                                <input type="submit" value="อัพเดต" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
