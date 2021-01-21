<?php include_once('./views/templates/header.php'); ?>
<div class="row club_section mt-4">
    <div class="col-md-6 col-sm-4 col-xs-6 club_section_info">
        <h3>Ваш заказ успешно оформлен!</h3>
        <p>Спасибо, что остаётесь с нами!</p>
        <a class="btn btn-primary btn-primary_article mt-5" href="<?= SITE_ROOT . 'main' ?>">Перейти на главную</a>
    </div>
    <div class="col-md-6 col-sm-4 col-xs-6">
        <div class="mt-3 mb-3">
            <div class="item_img">
                <a href="<?= SITE_ROOT . 'club' ?>"><img src="<?= IMG . 'cart/cart_img.jpg';?>" alt="Для собак" class="col-12"></a>
            </div>
        </div>
    </div>
</div>
<?php include_once('./views/templates/footer.php'); ?>
