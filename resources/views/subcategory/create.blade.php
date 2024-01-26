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
<form method="post" action="{{route('subcategory.store')}}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="category">Category</label>

        <select id="category" name="category">
            <option value="">select a category</option>

            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="sub">sub-category Name</label>
        <input id="sub" type="text" name="name" required>
    </div>
    <div class="form-group">
        <input type="file" name="file" required>
    </div>
    <button type="submit">Submit</button>
</form>

</body>
</html>
