<!DOctype html>
<html>
<head>
    <title></title>
</head>
<body>
<form method="post" action="{{route('brand.store')}}">
    @csrf
    <label>Brand-name</label>
    <input type="text" name="name" required >
    <button type="submit">submit</button>
</form>
</body>
</html>



