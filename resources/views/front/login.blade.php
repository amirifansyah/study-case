<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info')}}">{{Session::get('message')}}</p>
    @endif
    <form action="{{ route('login.store')}}" method="POST">
        {{ csrf_field() }}
        <input type="text" name="name">
        <input type="text" name="email">
        <input type="submit">
    </form>
</body>
</html>