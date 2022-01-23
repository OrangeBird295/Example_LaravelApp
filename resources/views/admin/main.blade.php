<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <?php

    $user = "Deezadis";
    $array = array("Home", "Member", "About");

    ?>


    @if($user == "Deezadis")
        <h1>Hello Admin {{$user}}</h1>
        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas temporibus ea non cum, dolore atque reiciendis sit laborum, pariatur itaque voluptates tempore optio fuga error totam corrupti consequatur beatae facere.</p>
    @else
        <h1>This user is not an Admin</h1>
    @endif


    @foreach($array as $menu)
        <a href="">{{$menu}}</a>
    @endforeach

    <ul>
    @for($i=1;$i<=5;$i++)
        <li>{{$i}}</li>
    @endfor
    </ul>
</body>
</html>