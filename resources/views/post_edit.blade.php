<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post-edit</title>
</head>

<body>
    <h1>EDIT POST</h1>
    <form action="/edit_post/{{$post->id}}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="post_title" value="{{$post->post_title}}">
        <textarea name="post_content">{{$post->post_content}}</textarea>
        <button type="submit">Save Changes</button>
    </form>
</body>

</html>