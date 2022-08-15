<!Doctype html>
<html lang="">
<head>
    <title>Shirts</title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>All Products under Shirts</h2>
<main class="container">

    @foreach ($shirts as $shirt)
        <a href="{{route('show',$shirt->id)}}">
        <div>
            <img src="{{ asset('images/productImgs/'.$shirt->file_path)}}" alt="">
            <p class="subcategory_name">{{$shirt->name}}</p>
            <h2 class="subcategory_price>"${{$shirt->price}}</h2>
        </div>
        </a>
            @endforeach

</main>


</body>
</html>
