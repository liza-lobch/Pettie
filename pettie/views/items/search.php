<?php include_once('./views/templates/header.php'); ?>
<h1 class="mt-4 mb-4"> <?php echo $h1 ?></h1>

<div class="row">
    <input class="search_panel_on_page col-5 ml-3" id="search_panel_on_page" type="text" placeholder="Поиск..." <?php if (isset($search_str)) : ?> value="<?= $search_str; ?>" <?php endif; ?>>
    <button class="col-1 search_btn" type="submit" onclick="itemSearchOnPage('<?= SITE_ROOT; ?>')">Найти</button>
</div>
<div class="row">
    <?php if (!isset($item_name)) : ?>
    <p class="mt-2 ml-3">Введите поисковый запрос и нажмите кнопку "Найти".</p>
    <?php endif; ?>
</div>

<?php if (isset($items)) : ?>
<?php if (empty($items)) : ?>
<div class="row">
    <h3>По Вашему запросу ничего не найдено.</h3>
</div>
<?php else : ?>
<div class="card-deck">
    <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2">
        <?php foreach ($items as $item): ?>
        <div class="col mb-5">
            <div class="card h-100">
                <a href="<?= SITE_ROOT . 'items/view/' . $item['item_id'];?>" class="text-center"><img src="<?= IMG . 'preview_img/' . $item['item_img_preview'];?>" alt="<?= $item['item_name']; ?>" class="card-img-top col-9 mt-4" alt="<?= $item['item_name']; ?>"></a>
                <div class="card-body">
                    <h5 class="card-title text-center"><?= $item['item_name']; ?></h5>
                    <p class="card-text text-center"><?= $item['item_unit_count']; ?> <?= $item['unit_name']; ?></p>
                    <p class="card-text text-center"><?= $item['manufacturer_name']; ?></p>
                    <h6 class="card-text text-center"><?= $item['item_price']; ?> руб.</h6>
                </div>
                <?php if (!User::checkIfUserIsAdmin()) : ?>
                <div class="card-footer">
                    <small class="text-muted"><a class="btn btn-center" onclick="addToCart(<?= $item['item_id']; ?>)">В корзину</a></small>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php include_once('./views/templates/footer.php'); ?>
