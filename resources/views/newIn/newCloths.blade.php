<!Doctype html>
<html lang="">
<head>
    <title>New in</title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>See all new products in clothing</h2>

<main class="container">

    @foreach ($newCloths as $newCloth)
        <div>
            <img src="{{ asset('images/productImgs/'.$newCloth->file_path)}}" alt="">
            <p>{{$newCloth->name}}</p>
            <h2>${{$newCloth->price}}</h2>

        </div>

    @endforeach

</main>


</body>
</html>
