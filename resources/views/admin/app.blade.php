
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@ifAdminАдминка:@endifAdmin @yield('title','Заказы')</title>

    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/styles/bootstrap4/bootstrap.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/styles/bootstrap4/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                Вернуться на сайт
            </a>

            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    @ifAdmin
                        <li class="nav-item dropdown">
                            <a id="navbarDropdownShop"  class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Магазин
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownShop">
                                <a class="dropdown-item @routeActive('orders.*')" href="{{ route('orders.index') }}">Заказы</a>
                                <a class="dropdown-item @routeActive('payments.*')" href="{{ route('payments.index') }}">Способы оплаты</a>
                                <a class="dropdown-item @routeActive('order_statuses.*')" href="{{ route('order_statuses.index') }}">Статусы заказа</a>
                            </div>
                        </li>
                        <li class="nav-item @routeActive('users.*')"><a href="{{ route('users.index') }}" class="nav-link">Пользователи</a></li>
                        <li class="nav-item @routeActive('categories.*')"><a href="{{ route('categories.index') }}" class="nav-link">Категории</a></li>
                        <li class="nav-item @routeActive('products.*')"><a href="{{ route('products.index') }}" class="nav-link">Товары</a></li>
                        <li class="nav-item @routeActive('properties.*')"><a href="{{ route('properties.index') }}" class="nav-link">Свойства</a></li>
                        <li class="nav-item @routeActive('coupons.*')"><a href="{{ route('coupons.index') }}" class="nav-link">Купоны</a></li>
                        <li class="nav-item @routeActive('banners.*')"><a href="{{ route('banners.index') }}" class="nav-link">Баннеры</a></li>
                        <li class="nav-item @routeActive('reviews.*')"><a href="{{ route('reviews.index') }}" class="nav-link">Отзывы</a></li>
                    @else
                        <li class="nav-item @routeActive('person.orders*')"><a href="{{ route('person.orders.index') }}" class="nav-link">Мои заказы</a></li>
                        <li class="nav-item @routeActive('person.personal-info*')"><a href="{{ route('person.personal-info') }}" class="nav-link">Личные данные</a></li>
                        @endifAdmin
                </ul>


                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('get-logout') }}">Выйти</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
</html>
