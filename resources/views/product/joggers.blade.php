<!Doctype html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href={{asset('vendor/css/subcategory.css')}}>
</head>
<body>
<h2>Show All Joggers</h2>
<main class="container">
    @foreach ($joggers as $jogger)
        <a href="{{route('show',$jogger->id)}}">
        <div>
            <img src="{{ asset('images/productImgs/'.$jogger->file_path)}}" alt="">
            <p class="subcategory_name">{{$jogger->name}}</p>
            <h2 class="subcategory_price">${{$jogger->price}}</h2>
        </div>
        </a>

    @endforeach
</main>
</body>
</html>
