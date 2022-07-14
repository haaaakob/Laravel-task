<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin page</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/allCss.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="info_div">
    <a href="{{route('logout')}}" class="logout">logout</a>
    <h2>admin page</h2>
    @foreach($loggedUser as $user)
        <img src="images/avatar/2.png" alt="img" class="avatar_div">
        <p>name: {{$user['name']}}</p>
        <p>surname: {{$user['surname']}}</p>
        <p>email: {{$user['email']}}</p>
    @endforeach
</div>

<div class="add_post">
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="error_div">
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
        <input type="file" id="post" class="form-control" name="post">
        <span class="text-danger">@error('post'){{$message}}@enderror</span>
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <br>
        <input type="submit" id="submit_post" value="{{__('Create post')}}" class="pull-right btn btn-sm btn-primary">
    </form>
</div>

<div>
    <div class="all_post_div">
        @foreach($post as $info)
            <div class="main_post">
                <img src="{{asset('images/gallery/'.$info['image'])}}" alt="img" class="post_img">
                <p>{{$info['title']}}</p>
                <p>{{$info['description']}}</p>
                <p class="comment">comments_________________________________</p>
                   @foreach($info['comments'] as $comm)
                       <p>{{$comm['text']}}</p>
                   @endforeach
                <form action="{{route('add_comment')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$info['id']}}" name="postId">
                    <input type="text" placeholder="add comment" name="comment">
                    <span class="text-danger">@error('comment'){{$message}}@enderror</span>
                  <button id="btn">add</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
<div class="pagination_div">
    {{$post->links()}}
</div>
</body>
</html>
