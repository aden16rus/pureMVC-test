<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row mt-2 mb-5">
        <div class="col-md-3">
            <a href="/">Main</a>
        </div>
        <div class="col-md-2 offset-md-7">
            <?if(Helper::isAdmin()){?>
                Hi, admin <a href="/logout">logout</a>
            <?} else {?>
                <a href="/login">Login</a>
            <?}?>
        </div>
    </div>