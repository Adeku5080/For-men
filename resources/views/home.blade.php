<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>WELCOME</h2>
@foreach ($categories as $category)
  <img src="{{ asset('images/'.$category->file_path)}}" alt="">
    <h3>{{$category->category_name}}</h3>

@endforeach

</body>
</html>
