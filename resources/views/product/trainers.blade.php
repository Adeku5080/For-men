<!Doctype html>
<html lang="">
<head>
    <title>New in</title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>All new in clothing</h2>
<main class="container">
    @foreach ($trainers as $trainer)
        <a href="{{route('show',$trainer->id)}}">
            <div>
                <img src="{{ asset('images/productImgs/'.$trainer->file_path)}}" alt="">
                <p class="subcategory_name">{{$trainer->name}}</p>
                <h2 class="subcategory_price">${{$trainer->price}}</h2>
            </div>
        </a>


    @endforeach
</main>

</body>
</html>
