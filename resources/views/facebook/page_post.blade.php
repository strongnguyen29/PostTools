<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fanpage Post</title>
    <style>
        .container {
            width: 1024px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="container">
    <header id="header">Fanpage Post</header>
    <div class="content">
        <form action="{{route('facebook.post')}}" method="POST">
            @csrf
            <div class="form-control">
                <label for="input-post-content">Nội dung post</label>
                <input type="text" name="post_content" id="input-post-content">
            </div>
            <button type="submit" class="btn">Post</button>
        </form>
    </div>
    <footer id="footer">

    </footer>
</div>
</body>
</html>