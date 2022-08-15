<!Doctype html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href={{asset('vendor/bootstrap/css/bootstrap.css')}}>
</head>
<body>
<div class="container">
    <form method="post" action="{{route('login')}}" class="mb-3">
        @csrf

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

        <div class="form-check">

            <label class="form-check-label" for="remember_me">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me"
                       value="{{old('remember') ? 'checked': ''}}">
                Remember Me
            </label>
        </div>

        <a href="{{route('password.request')}}">
            forgot your password?
        </a>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>


</body>
</html>
