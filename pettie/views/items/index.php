<?php include_once('./views/templates/header.php'); ?>
<h1 class="mt-4 mb-5"> <?php echo $h1 ?></h1>
<?php if (!User::checkIfUserIsAdmin()) : ?>
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
<div class="pagination mb-3">
    <?php if ($page>1): ?>
    <div><a class="pagination_item mr-4" href="<?= $path . '/1'?>"> &lt;&lt; </a></div>
    <div><a class="pagination_item mr-3" href="<?= $path . '/' . ($page-1) ?>"> &lt; </a></div>
    <?php endif; ?>
    <?php if ($pages>1): ?>
    <?php for ($i = 1; $i <= $pages; $i++): ?>
    <?php if ($i == ($page)): ?>
    <div><a class="pagination_item mr-1 ml-1 pagination_item_selected" href="<?= $path . '/' . ($i) ?>"><?php echo $i ?></a></div>
    <?php else : ?>
    <div><a class="pagination_item mr-1 ml-1" href="<?= $path . '/' . ($i) ?>"><?php echo $i ?></a></div>
    <?php endif; ?>
    <?php endfor; ?>
    <?php endif; ?>
    <?php if ($page < $pages): ?>
    <div><a class="pagination_item ml-3" href="<?= $path . '/' . ($page+1) ?>"> &gt; </a></div>
    <div><a class="pagination_item ml-4" href="<?= $path . '/' . $pages ?>"> &gt;&gt; </a></div>
    <?php endif; ?>

</div>
<?php else : ?>
<a href="<?= SITE_ROOT . 'items/add' ?>" class="btn btn-primary mb-4"><i class="fa fa-plus "></i> Добавить товар</a>
<table class="table">
    <thead>
        <tr>
            <th>
                Наименование
            </th>
            <th>
                Артикул
            </th>
            <th>
                Объем
            </th>
            <th>
                В наличии
            </th>
            <th>
                Производитель
            </th>
            <th>
                Категория
            </th>
            <th>
                Цена (руб.)
            </th>
            <th>
                Действия
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
            <td>
                <a href="<?= SITE_ROOT . 'items/view/' . $item['item_id'];?>">
                    <?= $item['item_name']; ?>
                </a>
            </td>
            <td> <?= $item['item_vendor_code']; ?></td>
            <td> <?= $item['item_unit_count']; ?> <?= $item['unit_name']; ?></td>
            <td> <?= $item['item_count']; ?></td>
            <td> <?= $item['manufacturer_name']; ?></td>
            <td> <?= $item['category_name']; ?></td>
            <td> <?= $item['item_price']; ?></td>
            <td>
                <div class="form">
                    <a href="<?= SITE_ROOT . 'items/edit/' . $item['item_id']; ?>" class="btn btn-warning mr-1">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-danger" onclick="deleteItem(<?= $item['item_id']; ?>, '<?= SITE_ROOT; ?>')">
                        <i class="fa fa-minus-circle"></i>
                    </a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
<?php include_once('./views/templates/footer.php'); ?>
