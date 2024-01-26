<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Category Name</label>
        <input type="text" name="name" required>
    </div>
    <div class="form-group">
        <input type="file" name="file">
    </div>
    <button type="submit">Submit</button>
</form>

</body>
</html>
