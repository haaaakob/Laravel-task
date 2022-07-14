<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>private</title>
</head>
<body>
<div style="margin: 80px">
    <a href="{{route('logout')}}" style="text-decoration: none">logout</a>
    <h2>user page</h2>
    @foreach($loggedUser as $user)
        <img src="images/avatar/2.png" alt="img" style="width: 100px; height: 100px">
        <p>name: {{$user['name']}}</p>
        <p>surname: {{$user['surname']}}</p>
        <p>email: {{$user['email']}}</p>
    @endforeach
</div>
<div>
    <div style="display: flex">
        @foreach($post as $info)
            <div style="width: 220px; height: 400px; border: 2px solid black; margin: 10px">
                <img src="{{asset('images/gallery/'.$info['image'])}}" alt="img" style="width: 200px; height: 120px;margin: 10px ">
                <p>{{$info['title']}}</p>
                <p>{{$info['description']}}</p>
                <p style="font-size: 10px; margin: 5px">comments_________________________________</p>
                    @foreach($info['comments'] as $comm)
                        <p>{{$comm['text']}}</p>
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
