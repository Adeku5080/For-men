<!Doctype html>
<html>
<head>
    <title></title>
</head>
<body>
 <h2>All products under ......</h2>
  @foreach($products as $product)
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
</body>
</html>
