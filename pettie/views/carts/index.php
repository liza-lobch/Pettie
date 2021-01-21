<?php include_once('./views/templates/header.php'); ?>

<?php if ($cartString === ""): ?>
<h3 class="row mt-4"> Ваша корзина пуста</h3>
<?php else: ?>
<div class="container">
    <div class="row mt-4">
        <h3> Ваша корзина</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Название
                    </th>
                    <th>
                        Цена за ед.
                    </th>
                    <th>
                        Количество
                    </th>
                    <th>
                        Общая сумма
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $sum = 0.0; ?>
                <?php foreach ($itemList as $item): ?>
                <tr>
                    <td> <?= $item['item_id']; ?></td>
                    <td> <?= $item['item_name']; ?></td>
                    <td> <?= $item['item_price']; ?> руб.</td>
                    <td> <?= $cart[$item['item_id']]; ?> шт.</td>
                    <td> <?= $item['item_price'] * $cart[$item['item_id']]; ?> руб.</td>
                    <?php $sum+= $item['item_price'] * $cart[$item['item_id']]; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <h2>Общая сумма: <?php echo $sum; ?> руб.</h2>
        </div>
        <div class="row">
            <div class="mt-5 mb-4">
                <a class="btn btn-primary_article mt-4 mr-5" onclick="clearCart('<?= SITE_ROOT; ?>')">Очистить корзину</a>
            </div>
            <div class="mt-5 mb-4">
                <a class="btn btn-primary mt-4 ml-5" href="cart/ordering">Перейти к оформлению</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php include_once('./views/templates/footer.php'); ?>
