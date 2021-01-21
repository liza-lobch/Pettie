<?php include_once('./views/templates/header.php'); ?>
<?php if (!User::checkIfUserIsAdmin()) : ?>
<div class="container">
    <h1>Ошибка</h1>
    <p>Что-то пошло не так...</p>
</div>
<?php else : ?>
<h1 class="mt-4 mb-5">Заказ №<?= $order[0]['order_id']; ?></h1>
<p class="text-center mt-5 mb-5"><?= $order[0]['order_info']; ?></p>
<table class="table mb-4">
    <thead>
        <tr>
            <th>
                Наименование товара
            </th>
            <th>
                Количество
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($order as $item_detail): ?>
        <tr>
            <td><a href="<?= SITE_ROOT . 'items/view/' . $item_detail['cart_item_id'];?>" target="_blank"><?= $item_detail['item_name']; ?></a></td>
            <td><?= $item_detail['cart_item_count']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div>
    <?php if ($order[0]['order_is_done'] == 0) : ?>
    <div class="form">
        <a class="btn btn-danger" onclick="updateOrderStatus(<?= $order[0]['order_id']; ?>, 1, '<?= SITE_ROOT; ?>')">
            Не обработан <i class="fa fa-close"></i>
        </a>
    </div>
    <?php elseif ($order[0]['order_is_done'] == 1): ?>
    <div class="form">
        <a class="btn btn-warning" onclick="updateOrderStatus(<?= $order[0]['order_id']; ?>, 2, '<?= SITE_ROOT; ?>')">
            Обработан <i class="fa fa-edit"></i>
        </a>
    </div>
    <?php else : ?>
    <div class="form">
        <a class="btn btn-success">
            Выполнен <i class="fa fa-check"></i>
        </a>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php include_once('./views/templates/footer.php'); ?>
