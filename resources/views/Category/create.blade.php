<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SaveIt</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <style>
        #navigation {
            box-shadow: 0 0 8px #888;
        }
        #form {
            margin-top: 32px;
        }
    </style>
</head>
<body>
<div class="container-fluid bg-faded p-3" id="navigation">
    <ul class="nav nav-pills container">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">ГЛАВНАЯ</a>
        </li>
    </ul>
</div>
<form class="container" id="form" action="{{ route('category.create.submit') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row justify-content-center">
        <h2>Новая категория</h2>
    </div>
    <div class="row justify-content-center">
        <div class="form-group col-md-6">
            <label for="name" class="col-form-label">Название:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group col-md-6">
            <label for="image" class="col-form-label">Рисунок:</label>
            <input type="file" class="form-control-file" id="image" accept=".svg" name="image" required>
        </div>
    </div>
    <div class="row justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
</form>
</body>
</html>
