<!Doctype html>
<html>
<head>
    <title></title>
</head>
<body>
<h1>see all products under</h1>

@foreach ($products as $product)
    <img src="{{ asset('images/productImgs/'.$product->file_path)}}" alt="">
    <p>{{$product->name}}</p>
    <h2>${{$product->price}}</h2>


@endforeach

</body>
</html>
