<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div style="margin: 80px">
    <a href="{{route('logout')}}">logout</a>
    <h2>admin page</h2>
    @foreach($loggedUser as $user)
        <img src="images/avatar/2.png" alt="img" style="width: 100px; height: 100px">
        <p>name: {{$user['name']}}</p>
        <p>surname: {{$user['surname']}}</p>
        <p>email: {{$user['email']}}</p>
    @endforeach
</div>

<div style="margin: 100px">
    @if ($message = Session::get('success'))
        <div class="alert alert-success" style="width: 400px">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <form action="{{route('create_post')}}" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="text" placeholder="title" name="title">
        </div>
        <span class="text-danger">@error('title'){{$message}}@enderror</span>
        <div class="mb-3">
            <input type="text" placeholder="description" name="description">
        </div>
        <span class="text-danger">@error('description'){{$message}}@enderror</span>
        <input type="file" style="width: 300px" class="form-control" name="post">
        <span class="text-danger">@error('post'){{$message}}@enderror</span>
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <br>
        <input type="submit" style="margin: 20px 0 100px 0 ; width: 100px" value="{{__('Create post')}}" class="pull-right btn btn-sm btn-primary">
    </form>
</div>

<div>
    <div style="display: flex">
        @foreach($post as $info)
            <div style="width: 220px; height: 400px; border: 2px solid black; margin: 10px">
                <img src="{{asset('images/gallery/'.$info['image'])}}" alt="img" style="width: 200px; height: 120px;margin: 10px ">
                <p>{{$info['title']}}</p>
                <p>{{$info['description']}}</p>
                <p style="font-size: 10px; margin: 5px">comments</p>
                @foreach($loggedUser as $forName)
                   @foreach($info['comments'] as $comm)
                       <p>{{ $forName['name'].':'.$comm['text']}}</p>
                   @endforeach
                @endforeach
                <form action="{{route('add_comment')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$info['id']}}" name="postId">
                  <input type="text" placeholder="add comment" name="comment">
                    <span class="text-danger">@error('comment'){{$message}}@enderror</span>
                  <button id="btn" style="width: 130px; margin: 3px; background-color: lightblue">add</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
