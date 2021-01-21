<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?= $title; ?> </title>
    <link href="<?= LIBS ?>bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="<?= CSS ?>style.css" rel="stylesheet" />
    <?php if ($title == 'Адреса магазинов') : ?>
    <script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
    <script type="text/javascript">
        var map;
        DG.then(function() {
            map = DG.map('map', {
                center: [59.96, 30.31],
                zoom: 10
            });
            //DG.marker([59.94, 30.31]).addTo(map);
            DG.marker([59.948203, 30.493160]).addTo(map).bindPopup('пр. Наставников, 25/3');
            DG.marker([59.928695, 30.408853]).addTo(map).bindPopup('Заневский пр., 10');
            DG.marker([59.980693, 30.211036]).addTo(map).bindPopup('Приморский пр., 72');
        });

    </script>
    <?php endif; ?>
</head>

<body>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">На сайте используются cookies</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Продолжая использовать сайт, вы соглашаетесь с использованием cookies.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Понятно</button>
                </div>
            </div>
        </div>
    </div>
    <div class="main-container">
        <header>
            <nav class="navbar navbar-expand header_top">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="container">
                        <div class="navbar-nav col-3">
                            <div class="nav-item mb-1">
                                <a class="nav-link" href="<?= SITE_ROOT . "main";?>">
                                    <img class="card-img-top mt-3 logo_main col-9" src="<?= IMG . "logo_main.png";?>" alt="Логотип">
                                </a>
                            </div>
                        </div>
                        <div class="navbar-nav">
                            <div class="nav-item">
                                <input class="search_panel" id="search_panel" type="text" placeholder="Поиск..."><button type="submit" class="search_btn">
                                    <i class="fa fa-search" onclick="itemSearch('<?= SITE_ROOT; ?>')"></i>
                                </button>
                            </div>
                        </div>
                        <?php if (!User::checkIfUserIsAdmin()) : ?>
                        <div class="navbar-nav">
                            <div class="nav-item ">

                                <i class="fa fa-phone footer-contacts__icon contact_phone"></i>
                                <a href="tel:+78127030202" class="user_menu_item contact_phone">(812)&nbsp;555-35-35</a>

                            </div>
                        </div>
                        <?php endif; ?>
                        <div>
                            <ul class="navbar-nav ml-auto user_menu">
                                <?php if (!User::checkIfUserIsAdmin()) : ?>
                                <li class="nav-item my-2  <?= ($title == 'Корзина') ? 'active' : '' ?>">
                                    <a class="nav-link user_menu_item" href="<?= SITE_ROOT . 'cart' ?>">Корзина</a>
                                </li>
                                <?php endif; ?>
                                <?php if (User::checkIfUserAuthorized()) : ?>
                                <?php if (!User::checkIfUserIsAdmin()) : ?>
                                <li class="nav-item my-2 ">
                                    <a class="nav-link user_menu_item" href="<?= SITE_ROOT . 'logout' ?>">Выход</a>
                                </li>
                                <?php endif; ?>
                                <?php else : ?>
                                <li class="nav-item my-2  <?= ($title == 'Регистрация') ? 'active' : '' ?>">
                                    <a class="nav-link user_menu_item" href="<?= SITE_ROOT . 'register' ?>">Регистрация</a>
                                </li>
                                <li class="nav-item my-2   <?= ($title == 'Авторизация') ? 'active' : '' ?>">
                                    <a class="nav-link user_menu_item" href="<?= SITE_ROOT . 'auth' ?>">Войти</a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php if (User::checkIfUserIsAdmin()) : ?>
                        <div class="navbar-nav">
                            <div class="nav-item dropdown my-2">
                                <div class="nav-link dropdown-toggle admin_sign" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
                                    Админ-панель
                                </div>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="<?= SITE_ROOT . 'logout' ?>">Выход</a>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
            <nav class="navbar main_navbar navbar-expand">
                <div class="collapse navbar-collapse" id="navbarSupportedContent ">
                    <div class="container">
                        <ul class="navbar-nav main_mav">
                            <?php if (User::checkIfUserIsAdmin()) : ?>
                            <li class="nav-item dropdown my-2 <?= ($title == 'Товары для животных') ? 'active' : '' ?>">
                                <a class="nav-link main_list_item dropdown-toggle" href="<?= SITE_ROOT . 'items' ?>" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
                                    Товары
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li class="dropdown dropdown-submenu"><a class="dropdown-item" href="<?= SITE_ROOT . 'items/cats/' ?>" class="dropdown-toggle dropdown-item">Кошки</a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a href="<?= SITE_ROOT . 'items/cats/food' ?>" class="dropdown-item">Корм</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/cats/fillers' ?>" class="dropdown-item">Наполнители</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/cats/careproducts' ?>" class="dropdown-item">Средства для ухода</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown dropdown-submenu"><a class="dropdown-item" href="<?= SITE_ROOT . 'items/dogs/' ?>" class="dropdown-toggle dropdown-item">Собаки</a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a href="<?= SITE_ROOT . 'items/dogs/food' ?>" class="dropdown-item">Корм</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/dogs/fillers' ?>" class="dropdown-item">Ошейники</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/dogs/careproducts' ?>" class="dropdown-item">Средства для ухода</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown dropdown-submenu"><a class="dropdown-item" href="<?= SITE_ROOT . 'items/birds/' ?>" class="dropdown-toggle dropdown-item">Птицы</a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a href="<?= SITE_ROOT . 'items/birds/food' ?>" class="dropdown-item">Корм</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/birds/birdcages' ?>" class="dropdown-item">Клетки</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/birds/toys' ?>" class="dropdown-item">Игрушки</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown dropdown-submenu"><a class="dropdown-item" href="<?= SITE_ROOT . 'items/fish/' ?>" class="dropdown-toggle dropdown-item">Рыбки</a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a href="<?= SITE_ROOT . 'items/fish/food' ?>" class="dropdown-item">Корм</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/fish/aquariums' ?>" class="dropdown-item">Аквариумы</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown dropdown-submenu"><a class="dropdown-item" href="<?= SITE_ROOT . 'items/rodents/' ?>" class="dropdown-toggle dropdown-item">Хорьки и грызуны</a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a href="<?= SITE_ROOT . 'items/rodents/food' ?>" class="dropdown-item">Корм</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/rodents/cages' ?>" class="dropdown-item">Клетки, переноски</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/rodents/toys' ?>" class="dropdown-item">Игрушки</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item my-2 <?= ($title == 'Клуб Пэтти') ? 'active' : '' ?>">
                                <a class="nav-link main_list_item" href="<?= SITE_ROOT . 'club' ?>">Статьи</a>
                            </li>
                            <li class="nav-item my-2 <?= ($title == 'Адреса магазинов') ? 'active' : '' ?>">
                                <a class="nav-link main_list_item" href="<?= SITE_ROOT . 'addresses' ?>">Адреса магазинов</a>
                            </li>
                            <li class="nav-item my-2 <?= ($title == 'Пользователи') ? 'active' : '' ?>">
                                <a class="nav-link main_list_item" href="<?= SITE_ROOT . 'users' ?>">Пользователи</a>
                            </li>
                            <li class="nav-item my-2 <?= ($title == 'Заказы') ? 'active' : '' ?>">
                                <a class="nav-link main_list_item" href="<?= SITE_ROOT . 'orders' ?>">Заказы</a>
                            </li>
                            <?php else : ?>
                            <li class="nav-item dropdown my-2 <?= ($title == 'Кошки') ? 'active' : '' ?>">
                                <a class="nav-link main_list_item dropdown-toggle" href="<?= SITE_ROOT . 'items/cats' ?>" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
                                    Кошки
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="<?= SITE_ROOT . 'items/cats/food' ?>">Корм</a>
                                    <a class="dropdown-item" href="<?= SITE_ROOT . 'items/cats/fillers' ?>">Наполнители</a>
                                    <a class="dropdown-item" href="<?= SITE_ROOT . 'items/cats/careproducts' ?>">Средства для ухода</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown my-2 <?= ($title == 'Собаки') ? 'active' : '' ?>">
                                <a class="nav-link main_list_item dropdown-toggle" href="<?= SITE_ROOT . 'items/dogs' ?>" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
                                    Собаки
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="<?= SITE_ROOT . 'items/dogs/food' ?>">Корм</a>
                                    <a class="dropdown-item" href="<?= SITE_ROOT . 'items/dogs/fillers' ?>">Ошейники</a>
                                    <a class="dropdown-item" href="<?= SITE_ROOT . 'items/dogs/careproducts' ?>">Средства для ухода</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown my-2 <?= ($title == 'Другие животные') ? 'active' : '' ?>">

                                <a href="#" class="nav-link main_list_item dropdown-toggle" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
                                    Другие животные
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li class="dropdown dropdown-submenu"><a href="<?= SITE_ROOT . 'items/birds' ?>" class="dropdown-toggle dropdown-item">Птицы</a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a href="<?= SITE_ROOT . 'items/birds/food' ?>" class="dropdown-item">Корм</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/birds/birdcages' ?>" class="dropdown-item">Клетки</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/birds/toys' ?>" class="dropdown-item">Игрушки</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown dropdown-submenu"><a href="<?= SITE_ROOT . 'items/fish' ?>" class="dropdown-toggle dropdown-item">Рыбки</a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a href="<?= SITE_ROOT . 'items/fish/food' ?>" class="dropdown-item">Корм</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/fish/aquariums' ?>" class="dropdown-item">Аквариумы</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown dropdown-submenu"><a href="<?= SITE_ROOT . 'items/rodents' ?>" class="dropdown-toggle dropdown-item">Хорьки и грызуны</a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li><a href="<?= SITE_ROOT . 'items/rodents/food' ?>" class="dropdown-item">Корм</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/rodents/cages' ?>" class="dropdown-item">Клетки, переноски</a></li>
                                            <li><a href="<?= SITE_ROOT . 'items/rodents/toys' ?>" class="dropdown-item">Игрушки</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item my-2 <?= ($title == 'Клуб Пэтти') ? 'active' : '' ?>">
                                <a class="nav-link main_list_item" href="<?= SITE_ROOT . 'club' ?>">Клуб Пэтти</a>
                            </li>
                            <li class="nav-item my-2 <?= ($title == 'Адреса магазинов') ? 'active' : '' ?>">
                                <a class="nav-link main_list_item" href="<?= SITE_ROOT . 'addresses' ?>">Адреса магазинов</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container">
