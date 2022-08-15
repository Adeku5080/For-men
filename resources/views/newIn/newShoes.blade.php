<!Doctype html>
<html lang="">
<head>
    <title>New in</title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>See all new products under shoe</h2>
<main class="container">
    @foreach ($newShoes as $newShoe)
        <div>
            <img src="{{ asset('images/productImgs/'.$newShoe->file_path)}}" alt="">
            <p>{{$newShoe->name}}</p>
            <h2>${{$newShoe->price}}</h2>
        </div>

    @endforeach
</main>
</body>
</html>

