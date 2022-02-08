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
                    @if(session("Success"))
                        <div class="alert alert-success">{{session("Success")}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header"> ตารางข้อมูลแผนก </div>
                    </div>
                </div>
                <!-- ส่วนอีก 4 ส่วนเป็นแบบฟอร์ม -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> แบบฟอร์ม </div>
                        <div class="card-body">
                            <!-- จะวิ่งไปที่ Controller(store) เมื่อกดปุ่ม -->
                            <form action="{{route('addDepartment')}}" method="post">
                                <!-- เพื่อป้องกันการ Hack ระบบรูปแบบการป้อน Scirpt -->
                                @csrf
                                <div class="form-group">
                                    <label for="department_name"> ชื่อแผนก </label>
                                    <input type="text" class="form-control" name="department_name">
                                </div>
                                @error('department_name')
                                    <div class="my-2">
                                    <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <br>
                                <input type="submit" value="บันทึก" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
