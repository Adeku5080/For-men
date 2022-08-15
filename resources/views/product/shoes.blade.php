<!Doctype html>
<html lang="">
<head>
    <title>New in</title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>All products in shoes</h2>
<main class="container">
    @foreach ($shoes as $shoe)
        <a href="{{route('show',$shoe->id)}}">
        <div>
            <img src="{{ asset('images/productImgs/'.$shoe->file_path)}}" alt="">
            <p class="subcategory_name">{{$shoe->name}}</p>
            <h2 class="subcategory_price>${{$shoe->price}}</h2>
        </div>
        </a>
    @endforeach
</main>


</body>
</html>

