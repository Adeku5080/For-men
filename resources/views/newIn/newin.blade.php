<!Doctype html>
<html lang="">
<head>
    <title>All Products</title>
    <link rel="stylesheet" href='/css/allproducts.css'>
</head>
<body>
<h2>All new products</h2>

<main class="container">

    @foreach ($newProducts as $newProduct)
        <a>

        <div>
        <img src="{{ asset('images/productImgs/'.$newProduct->file_path)}}" alt="">
        <p>{{$newProduct->name}}</p>
        <h2>${{$newProduct->price}}</h2>

        </div>

        </a>

    @endforeach

</main>
</body>
</html>
