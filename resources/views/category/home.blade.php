<!Doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('vendor/css/header.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous"/>
</head>
<body>
<header class="header">
    <a href="#">Menswear</a>

    <div id="search-bar">
        <input type="search" placeholder="Search">
    </div>

    <a href="#">
        <i class="far fa-user"></i>
    </a>
    <a href="#">
        <i class="fas fa-shopping-cart">Cart</i>
    </a>
</header>
<nav>
    <a href="#">New in</a>
    <a href="#">Clothing</a>
    <a href="#">shoes</a>
    <a href="#">Accessories</a>
    <a href="#">Brands</a>


</nav>
<h2>WELCOME</h2>
@foreach ($categories as $category)
    <a href="{{ route('category.show', $category->id) }}">
        <img src="{{ asset('images/'.$category->file_path)}}" alt="">
        <h3>{{$category->name}}</h3>
    </a>
@endforeach

</body>
</html>

