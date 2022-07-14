<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>registration page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/allCss.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<div class="reg_div">
    <form action="{{route('regProcess')}}" method="post">
        @csrf
        @if(\Illuminate\Support\Facades\Session::get('success'))
            <div class="alert alert-success">
                {{\Illuminate\Support\Facades\Session::get('success')}}
            </div>
        @endif
        @if(\Illuminate\Support\Facades\Session::get('fail'))
            <div class="alert alert-danger">
                {{\Illuminate\Support\Facades\Session::get('fail')}}
            </div>
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="mb-3">
            <input type="text" name="name" id="name" aria-describedby="emailHelp" placeholder="name">
        </div>
        <span class="text-danger">@error('name'){{$message}}@enderror</span>
        <div class="mb-3">
            <input type="text" name="surname" id="surname" aria-describedby="emailHelp" placeholder="surname">
        </div>
        <span class="text-danger">@error('surname'){{$message}}@enderror</span>
        <div class="mb-3">
            <input type="email" name="email" id="email" aria-describedby="emailHelp" placeholder="Email address">
        </div>
        <span class="text-danger">@error('email'){{$message}}@enderror</span>
        <div class="mb-3">
            <input type="password" id="password" placeholder="Password" name="password">
        </div>
        <span class="text-danger">@error('password'){{$message}}@enderror</span>
        <div class="mb-3">
            <input type="password" id="confirm" placeholder="Confirm Password" name="confirmPassword">
        </div>
        <span class="text-danger">@error('confirmPassword'){{$message}}@enderror</span>
        <a href="{{route('login')}}" class="logout">
            <p>{{__('already registered ?')}}</p>
        </a>

        <input type="reset" style="margin: 10px">
        <br>
        <button type="submit" class="btn btn-primary" id="register" name="send">{{__('Submit')}}</button>
    </form>
</div>

</body>
</html>
