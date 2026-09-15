<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my lavarel journey</title>
</head>
<!--View (resources/views/): Your Blade template handles the frontend
 presentation (the HTML forms).-->

<body>

    @auth
    <p>login successfull</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log Out</button>
    </form>
    <div style="border: 3px solid black">
        <h2> All Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 30px; margin:10px; width:fit-content; align-items:column;">
            <h3> {{$post['post_title']}} <em style="font-size: 15px;">by {{$post->User->name}}</em> </h3>
            {{$post['post_content']}}
        </div>
        <p><a href="/post_edit/{{$post->id}}">Edit Post</a></p>
        <form action="/delete_post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Post</button>
        </form>
        @endforeach
    </div><br>
    <div style="border: 3px solid black">
        <form action="/createPost" method="POST">
            @csrf
            <input type="text" name="post_title" placeholder="post title">
            <textarea name="post_content" placeholder="post content"></textarea>
            <button type="submit">paste</button>
        </form>

    </div><br>

    @else
    <h1>this framework is amazing</h1>
    <div style="border: 3px solid black">
        <form action="/login" method="POST">
            @csrf
            <br>enter your info:<br>
            <input type="text" name="name" placeholder="name">
            <input type="text" name="email" placeholder="address">
            <input type="password" name="password" placeholder="password">
            <button type="submit">submit</button>
            <br><br>
        </form>
    </div>

    <div style="border: 3px solid black">
        <form action="/connection" method="POST">
            @csrf
            <br>enter your info:<br>
            <input type="text" name="connect_name" placeholder="name">
            <input type="password" name="connect_password" placeholder="password">
            <button type="submit">connect to existing account</button>
            <br><br>

        </form>
    </div>
    <div style="border: 3px solid black">
        <h2> All Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 30px; margin:10px; width:fit-content; display:flex; flex-wrap:wrap; flex-direction:row; gap: 10px; align-items:center; justify-content:flex-start">
            <h3> {{$post['post_title']}} </h3>
            {{$post['post_content']}}
        </div>
        @endforeach
    </div>
         
    @endauth
</body>
                                              
<!--Environment (.env): this will manage your sensitive configuration (database credentials for
 MySQL Workbench) without hardcoding credentials in your codebase.-->

<!--CSRF Protection: Always place the @csrf directive inside every Blade form (<form method="POST">
     @csrf ... </form>) to prevent Cross-Site Request Forgery attacks.-->

</html>