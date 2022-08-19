<!Doctype html>
<html>
<head>
    <title>

    </title>
</head>

<body>

  <h2>Cart Page</h2>

  <div>
      @foreach($cartItems as $cartItem)
         <p>$cartItem->name</p>
          @endforeach
  </div>


{{--@foreach($cartItems as $cartItem)--}}
{{--    <div>{{$cartItem->name}}</div>--}}

{{--@endforeach--}}




</body>
</html>
