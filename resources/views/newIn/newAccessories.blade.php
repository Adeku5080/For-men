<!Doctype html>
<html lang="">
<head>
    <title>New in</title>
</head>
<body>
<h2>All new in Accessories</h2>
@foreach ($newAccessories as $newAccessory)
    <img src="{{ asset('images/productImgs/'.$newAccessory->file_path)}}" alt="">
    <p>{{$newAccessory->name}}</p>
    <h2>${{$newAccessory->price}}</h2>

@endforeach
</body>
</html>
