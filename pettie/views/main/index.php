<?php include_once('./views/templates/header.php'); ?>
<div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="<?= SITE_ROOT . 'items/view/61';?>"><img class="d-block w-100" src="<?= IMG . 'main_page/slider/img1.jpg';?>" alt="Первый слайд"></a>
        </div>
        <div class="carousel-item">
            <a href="<?= SITE_ROOT . 'items/view/63';?>"><img class="d-block w-100" src="<?= IMG . 'main_page/slider/img2.jpg';?>" alt="Второй слайд"></a>
        </div>
        <div class="carousel-item">
            <a href="<?= SITE_ROOT . 'items/view/62';?>"><img class="d-block w-100" src="<?= IMG . 'main_page/slider/img3.jpg';?>" alt="Третий слайд"></a>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<h2 class="mt-5 mb-4">Каталог товаров</h2>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6 item">
        <div class="mt-3 mb-3">
            <div class="item_img">
                <a href="<?= SITE_ROOT . 'items/cats' ?>"><img src="<?= IMG . 'main_page/cat.jpg';?>" alt="Для кошек" class="col-12"></a>
            </div>
            <div class="item_name">
                <a href="<?= SITE_ROOT . 'items/cats' ?>">Для кошек</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 item">
        <div class="mt-3 mb-3">
            <div class="item_img">
                <a href="<?= SITE_ROOT . 'items/dogs' ?>"><img src="<?= IMG . 'main_page/dog.jpg';?>" alt="Для собак" class="col-12"></a>
            </div>
            <div class="item_name">
                <a href="<?= SITE_ROOT . 'items/dogs' ?>">Для собак</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-6 item">
        <div class="mt-3 mb-3">
            <div class="item_img">
                <a href="<?= SITE_ROOT . 'items/birds' ?>"><img src="<?= IMG . 'main_page/bird.jpg';?>" alt="Для птиц" class="col-12"></a>
            </div>
            <div class="item_name">
                <a href="<?= SITE_ROOT . 'items/birds' ?>">Для птиц</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-6 item">
        <div class="mt-3 mb-3">
            <div class="item_img">
                <a href="<?= SITE_ROOT . 'items/fish' ?>"><img src="<?= IMG . 'main_page/fish.jpg';?>" alt="item_name" class="col-12"></a>
            </div>
            <div class="item_name">
                <a href="<?= SITE_ROOT . 'items/fish' ?>">Для рыбок</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-6 item">
        <div class="mt-3 mb-3">
            <div class="item_img">
                <a href="<?= SITE_ROOT . 'items/rodents' ?>"><img src="<?= IMG . 'main_page/rodent.jpg';?>" alt="Для хорьков и грызунов" class="col-12"></a>
            </div>
            <div class="item_name">
                <a href="<?= SITE_ROOT . 'items/rodents' ?>">Для хорьков и грызунов</a>
            </div>
        </div>
    </div>
</div>
<h2 class="mt-5 mb-4">Клуб Пэтти</h2>
<div class="row club_section">
    <div class="col-md-6 col-sm-6 col-xs-12 club_section_info">
        <h3 class="mt-3">Читайте интересные подборки про домашних животных!</h3>
        <a class="btn btn-primary btn-primary_article mt-3" href="<?= SITE_ROOT . 'club' ?>">Перейти</a>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="mt-3 mb-3">
            <div class="item_img">
                <a href="<?= SITE_ROOT . 'club' ?>"><img src="<?= IMG . 'main_page/animals.jpg';?>" alt="Для собак" class="col-12"></a>
            </div>
        </div>
    </div>
</div>

<?php include_once('./views/templates/footer.php'); ?>
