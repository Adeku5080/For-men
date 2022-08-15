<!Doctype html>
<html lang="">
<head>
    <title>New in</title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>Search Results</h2>

<main class="container">
    @foreach ($products as $product)
        <div>
            <img src="{{ asset('images/productImgs/'.$product->file_path)}}" alt="product-img">
            <p>{{$product->name}}</p>
            <h2>${{$product->price}}</h2>
        </div>
</main>

@endforeach
</body>
</html>
