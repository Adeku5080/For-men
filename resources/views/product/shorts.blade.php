<!Doctype html>
<html lang="">
<head>
    <title>Shorts</title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>All Products under shorts</h2>
<main class="container">
    @foreach ($shorts as $short)
        <a href="{{route('show',$short->id)}}">
        <div>
            <img src="{{ asset('images/productImgs/'.$short->file_path)}}" alt="">
            <p class="subcategory_name">{{$short->name}}</p>
            <h2 class="subcategory_price>${{$short->price}}</h2>
        </div>
        </a>

    @endforeach
</main>


</body>
</html>
