<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About me</title>
</head>
<body>
    <h1> About Me</h1>
    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam magnam quis, asperiores laborum maiores eos corrupti, nostrum optio nihil eum delectus omnis? Doloremque repudiandae est eius sunt dolor consequatur natus.</p>

    <p>ที่อยู่ : {{$addr}}</p>
    <p>เบอร์ติดต่อ : {{$phone}}</p>
    <p>Email : {{$mail}}</p>
    <a href="{{url('/')}}">Home</a>
    <a href="{{route('about')}}">About</a>
    <a href="{{route('admin')}}">Admin</a>
    <a href="{{route('member')}}">Member</a>
</body>
</html>