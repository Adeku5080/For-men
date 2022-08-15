<!Doctype html>
<html lang="">
<head>
    <title>Boots</title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>All Products under boots</h2>
<main class="container">
    @foreach ($boots as $boot)
        <a href="{{route('show',$boot->id)}}">
            <div>
                <img src="{{ asset('images/productImgs/'.$boot->file_path)}}" alt="">
                <p class="subcategory_name">{{$boot->name}}</p>
                <h2 class="subcategory_price">${{$boot->price}}</h2>
            </div>
        </a>

    @endforeach
</main>


</body>
</html>
