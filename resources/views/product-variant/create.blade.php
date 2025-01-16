<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <form method="post" action="{{route('product-variant.store')}}" enctype="multipart/form-data">
 @csrf
  <div>
        <label for="sub">Product</label>
        <select id="product" name="product">
            <option value="">select a product</option>

            @forEach($products as $product)
             <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach

    </div>

    <div>
        <label>Product variant name </label>
        <input type='text' name='variant_name'>

    </div>

       <div class="form-group">
        <label>file-Path</label>
        <input type="file" name="file" required>
        @if ($errors->has('file'))
            <small>{{$errors->first('file')}}</small>
        @endif
    </div>

    <div> 
        
        
        <div>

      <div>
        <label>Quantity</label>
        <input type="number" name="quantity">
    </div>


    <div>
        <label>Description</label>
        <textarea name="product_detail">

        </textarea>
        @if ($errors->has('description'))
            <small>{{$errors->first('description')}}</small>
        @endif
    </div>

  


           <button type="submit">Submit</button>


  </form>

</body>
</html>