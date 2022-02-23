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
                        <div class="card-header"> ตารางข้อมูลบริการ </div>
                        <table class="table">
                        <table class="table table-striped">
                            <thead> 
                                <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ภาพประกอบ</th>
                                <th scope="col">ชื่อบริการ</th>
                                <th score="col">Create_At</th>
                                <th score="col">Edit</th>
                                <th score="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $row)
                                <tr>
                                    <th>{{$services->firstItem()+$loop->index}}</th>
                                    <td>{{$row->service_image}}</td>
                                    <td>{{$row->user->service_name}}</td>
                                    <td>
                                        @if($row->created_at == NULL)
                                            ไม่ถูกนิยาม
                                        @else
                                            {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('department/edit/'.$row->id)}}" class="btn btn-primary">แก้ไข</a>
                                    </td>
                                    <td>
                                        <a href="{{url('department/sofedelete/'.$row->id)}}" class="btn btn-danger">ลบข้อมูล</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$services->links()}}
                    </div>
                </div>
                <!-- ส่วนอีก 4 ส่วนเป็นแบบฟอร์ม -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> แบบฟอร์มบริการ </div>
                        <div class="card-body">
                            <!-- จะวิ่งไปที่ Controller(store) เมื่อกดปุ่ม -->
                            <form action="{{route('addDepartment')}}" method="post">
                                <!-- เพื่อป้องกันการ Hack ระบบรูปแบบการป้อน Scirpt -->
                                @csrf
                                <div class="form-group">
                                    <label for="service_name"> ชื่อบริการ </label>
                                    <input type="text" class="form-control" name="service_name">
                                </div>
                                @error('service_name')
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
