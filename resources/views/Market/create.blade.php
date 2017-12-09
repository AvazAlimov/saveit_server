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
<form class="container" id="form" action="{{ route('market.create.submit') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row justify-content-center">
        <h2>Новый магазин</h2>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="login" class="col-form-label">Логин:</label>
                    <input type="text" class="form-control" id="login" name="login" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password" class="col-form-label">Пароль:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name" class="col-form-label">Название:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="address" class="col-form-label">Адрес:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phone" class="col-form-label">Номер телефона:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="+998" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="image" class="col-form-label">Рисунок:</label>
                    <input type="file" class="form-control-file" id="image" accept=".png,.jpg,.jpeg,.svg" name="image">
                </div>
            </div>
            <input type="hidden" class="form-control" id="latitude" name="latitude" required>
            <input type="hidden" class="form-control" id="longitude" name="longitude" required>
        </div>
        <div class="col-md-6">
            <div id="map" style="width: 100%; height: 100%;">
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <hr class="col-md-12">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
</form>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>
    var map;
    var point = false;

    function initMaps() {
        map = new ymaps.Map("map", {
            center: [41.299496, 69.240073],
            zoom: 13,
            controls: []
        }, {searchControlProvider: 'yandex#search'});

        map.controls.add('geolocationControl');
        map.controls.add('searchControl');
        map.controls.add('zoomControl');
        map.controls.get('searchControl').options.set('size', 'large');

        map.events.add('click', function (event) {
            var coords = event.get('coords');
            if (point === false) {
                point = new ymaps.Placemark(coords, {balloonContent: 'Ваш магазин'}, {
                    draggable: true,
                    preset: 'islands#redHomeIcon',
                    iconColor: '#F44336'
                });
                map.geoObjects.add(point);
                point.events.add('dragend', function () {
                    setPoint();
                });
                setPoint();
            }
        });
    }

    function setPoint() {
        var coords = point.geometry.getCoordinates();
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            document.getElementById("address").value = firstGeoObject.getAddressLine();
            document.getElementById("latitude").value = coords[0];
            document.getElementById("longitude").value = coords[1];
        });
    }

    ymaps.ready(initMaps);
</script>
</body>
</html>
