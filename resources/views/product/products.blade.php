<!Doctype html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('vendor/css/products.css') }}">

</head>
<body>
<Main class="container">
    <h2>All products under ......</h2>
    @foreach($products as $product)
        <div class="image-container">
            <a href={{route('product.show',$product->id)}}>
                <img src="{{$product->file_path}}" alt="image"/>
            </a>
        </div>
        <div>
            {{$product->name}}

        </div>
        <div>
            ${{$product->price}}

        </div>
        <div>
            {{$product->description}}

        </div>
    @endforeach
</Main>

</body>
</html>
