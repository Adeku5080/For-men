<!Doctype html>
<html>
<head>
    <title></title>
</head>
<body>
@foreach ($subCategories as $subCategory)
    <a href="{{route('subcategory.show',$subCategory->id)}}">
        <img src="{{ asset('images/subcategoriesImgs/'.$subCategory->file_path)}}" alt="">
        <h3>{{$subCategory->name}}</h3>
    </a>

@endforeach

</body>
</html>
