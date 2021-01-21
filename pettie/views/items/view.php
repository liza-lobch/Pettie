<?php include_once('./views/templates/header.php'); ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 col-sm-12">
            <img src="<?= IMG . 'main_img/' . $item['item_img_main'];?>" class="card-img-top" alt="<?= $item['item_name']; ?>">
        </div>
        <div class="col-md-6 col-sm-12 mt-4">
            <h2 class="mb-4"><?= $item['item_name']; ?></h2>
            <p><b>Тип животного:</b> <?= $item['animal_type_name']?></p>
            <p><b>Артикул:</b> <?= $item['item_vendor_code']?></p>
            <p><b>Производитель:</b> <?= $item['manufacturer_name']?></p>
            <p><b>Объем:</b> <?= $item['item_unit_count']?> <?= $item['unit_name']?></p>
            <p><b>В наличии:</b> <?= $item['item_count']?></p>
            <h6><b>Цена:</b> <?= $item['item_price']?></h6>
            <?php if (!User::checkIfUserIsAdmin()) : ?>
            <div class="row">
                <a class="btn btn-primary mt-4" onclick="addToCart(<?= $item['item_id']; ?>)">Добавить в корзину </a>
            </div>
            <?php else : ?>
            <div class="row mt-3">
                <a href="<?= SITE_ROOT . 'items/edit/' . $item['item_id']; ?>" class="btn btn-warning mr-3">Редактировать</a>
                <a class="btn btn-danger" onclick="deleteItem(<?= $item['item_id']; ?>, '<?= SITE_ROOT; ?>')">Удалить</a>
            </div>            
            <?php endif; ?>
        </div>
        <div class="row col-12 mt-5">
            <p><b>Состав:</b> <?= $item['item_structure']?></p>
            <p><b>Описание:</b> <?= $item['item_desc']?></p>
        </div>
    </div>
</div>
<?php include_once('./views/templates/footer.php'); ?>
