<?php include_once('./views/templates/header.php'); ?>
<h1 class="mt-4 mb-5"> <?php echo $h1 ?></h1>

<?php if (!User::checkIfUserIsAdmin()) : ?>
<div class="container">
    <h1>Ошибка</h1>
    <p>Что-то пошло не так...</p>
</div>
<?php else : ?>
<table class="table">
    <thead>
        <tr>
            <th>
                Заказы
            </th>
            <th>
                Статус заказа
            </th>
            <th>
                Изменить статус
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td>
                <a href="<?= SITE_ROOT . 'orders/view/' . $order['order_id'];?>">
                    Заказ №<?= $order['order_id']; ?>
                </a>
            </td>
            <?php if ($order['order_is_done'] == 0) : ?>
            <td>Не обработан</td>
            <td>
                <div class="form">
                    <a class="btn btn-danger" onclick="updateOrderStatus(<?= $order['order_id']; ?>, 1, '<?= SITE_ROOT; ?>')">
                        <i class="fa fa-close"></i>
                    </a>
                </div>
            </td>
            <?php elseif ($order['order_is_done'] == 1): ?>
            <td>Обработан</td>
            <td>
                <div class="form">
                    <a class="btn btn-warning" onclick="updateOrderStatus(<?= $order['order_id']; ?>, 2, '<?= SITE_ROOT; ?>')">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
            </td>
            <?php else : ?>
            <td>Выполнен</td>
            <td>
                <div class="form">
                    <a class="btn btn-success">
                        <i class="fa fa-check"></i>
                    </a>
                </div>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
<?php include_once('./views/templates/footer.php'); ?>
