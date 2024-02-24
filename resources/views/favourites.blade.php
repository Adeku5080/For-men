<!Doctype html>
<html>
<head>
    <title>

    </title>
        <link rel="stylesheet" href="{{ asset('vendor/css/products.css') }}">

    </head>


<body>
<h1>All saved items</h1>
@foreach($favourites as $favourite)
<div class="products_container">
    <div class="product"> 
        <div class="image-container">
                        <img src="{{$favourite->product->file_path}}" alt="image"/>
                </div>
                <div class="name">
                    {{$favourite->product->name}}

                </div>
                <div class="price">
                    ${{$favourite->product->price}}

                </div>
                <div>
</div>
 {{-- <p>{{$favourite->product->name}}<p> --}}
@endforeach
</body>
</html>
