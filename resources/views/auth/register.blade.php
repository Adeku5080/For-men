
<!Doctype html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href={{asset('vendor/bootstrap/css/bootstrap.css')}}>
</head>
<body>
<div class="container">
    <form method="post" action="{{route('register')}}" class="mb-3">
        @csrf

        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{old('name')}}" class="form-control">
        @if($errors->has('name'))
            <small>{{ $errors->first('name') }}</small>
        @endif
        <br/><br/>

        <label class="form-label">E-mail</label>
        <input type="text" name="email" value="{{old('email')}}" class="form-control">
        @if($errors->has('email'))
            <small>{{ $errors->first('email') }}</small>
        @endif
        <br/><br/>

        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control">
        @if($errors->has('password'))
            <small>{{ $errors->first('password') }}</small>
        @endif
        <br/><br/>

        <label class="form-label"> Password-Confirm</label>
        <input type="password" name="password_confirmation" class="form-control"><br/><br/>

        <button type="submit" class="btn btn-primary">Register</button>

        <p> Already have an account? <a href="{{route('login')}}">Login</a></p>

    </form>

</div>




</body>
</html>
