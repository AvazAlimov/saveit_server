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

        #pills-tabContent {
            margin-top: 16px;
        }
    </style>
</head>
<body>
<div class="container-fluid bg-faded p-3" id="navigation">
    <ul class="nav nav-pills container" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
               aria-controls="pills-home" aria-selected="true">МАГАЗИНЫ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
               aria-controls="pills-profile" aria-selected="false">КАТЕГОРИИ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
               aria-controls="pills-contact" aria-selected="false">ПРОДУКТЫ</a>
        </li>
    </ul>
</div>

<div class="tab-content container" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <h1 class="display-5">
            Магазины
        </h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Адрес</th>
                <th scope="col">Координаты</th>
                <th scope="col">Телефон</th>
                <th scope="col">Добавлен</th>
                <th scope="col">Изменить</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($markets as $market)
                <tr>
                    <th scope="row">{{ $market->id }}</th>
                    <td>{{ $market->name }}</td>
                    <td>{{ $market->address }}</td>
                    <td>{{ $market->latitude }};{{ $market->longitude }}</td>
                    <td>{{ $market->phone }}</td>
                    <td>{{ $market->created_at }}</td>
                    <td class="text-center" style="width: 50px;">
                        <button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td class="text-center" style="width: 50px;">
                        <form action="{{ route('market.delete', $market->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form method="get" action="{{ route('market.create') }}">
            <input type="submit" class="btn btn-primary" value="Добавить магазин"/>
        </form>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <h1 class="display-5">
            Категории
        </h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Добавлен</th>
                <th scope="col">Изменён</th>
                <th scope="col">Изменить</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td class="text-center" style="width: 50px;">
                        <button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td class="text-center" style="width: 50px;">
                        <form action="{{ route('category.delete', $category->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form method="get" action="{{ route('category.create') }}">
            <input type="submit" class="btn btn-primary" value="Добавить категорию"/>
        </form>
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <h1 class="display-5">
            Продукты
        </h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Магазин</th>
                <th scope="col">Название</th>
                <th scope="col">Срок годности</th>
                <th scope="col">Начальная цена</th>
                <th scope="col">Скидка</th>
                <th scope="col">Конечная цена</th>
                <th scope="col">Ед. изм</th>
                <th scope="col">Категория</th>
                <th scope="col">Изменить</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->getMarketName() }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->date }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->discount }} %</td>
                    <td>{{ $product->new_price }}</td>
                    <td>{{ $product->unit }}</td>
                    <td>{{ $product->getCategoryName() }}</td>
                    <td class="text-center" style="width: 50px;">
                        <button class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td class="text-center" style="width: 50px;">
                        <form action="{{ route('product.delete', $product->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form method="get" action="{{ route('product.create') }}">
            <input type="submit" class="btn btn-primary" value="Добавить продукт"/>
        </form>
    </div>
</div>
</body>
</html>
