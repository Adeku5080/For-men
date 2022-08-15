<!Doctype html>
<html lang="">
<head>
    <title>T-shirts</title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>All new in clothing</h2>
<main class="container">
    @foreach ($tshirts as $tshirt)
        <a href="{{route('show',$tshirt->id)}}">
        <div>
            <img src="{{ asset('images/productImgs/'.$tshirt->file_path)}}" alt="">
            <p class="subcategory_name">{{$tshirt->name}}</p>
            <h2 class="subcategory_price">${{$tshirt->price}}</h2>
        </div>
        </a>
    @endforeach
</main>


</body>
</html>

