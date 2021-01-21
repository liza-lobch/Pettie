<?php include_once('./views/templates/header.php'); ?>

<h1 class="mt-3 mb-5"> <?php echo $h1 ?></h1>
<?php if (!User::checkIfUserIsAdmin()) : ?>
<p>Мы находимся в Санкт-Петербурге по следующим адресам:</p>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="row">
            <?php foreach ($addresses as $address): ?>
            <div class="card mb-4 article-card">
                <div class="card-body">
                    <h5 class="card-title">м. <?= $address['metro_station_name']; ?>, <?= $address['shop_address_name']; ?></h5>
                    <p class="card-text"><?= $address['shop_address_phone']; ?></p>
                    <p class="card-text"><?= $address['shop_address_work_time']; ?></p>
                    <?php if (User::checkIfUserIsAdmin()) : ?>
                    <div class="row mt-3">
                        <a href="<?= SITE_ROOT . 'addresses/edit/' . $address['shop_address_id']; ?>" class="btn btn-warning mr-3">Редактировать</a>
                        <a class="btn btn-danger" onclick="deleteAddress(<?= $address['shop_address_id']; ?>, '<?= SITE_ROOT; ?>')">Удалить</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div id="map" style="width:600px; height:468px"></div>
    </div>
</div>
<?php else : ?>
<a href="<?= SITE_ROOT . 'addresses/add' ?>" class="btn btn-primary mb-4"><i class="fa fa-plus "></i> Добавить адрес</a>

<table class="table">
    <thead>
        <tr>
            <th>
                Адрес
            </th>
            <th>
                Станция метро
            </th>
            <th>
                Телефон
            </th>
            <th>
                Рабочее время
            </th>
            <th>
                Действия
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($addresses as $address): ?>
        <tr>
            <td><?= $address['shop_address_name']; ?></td>
            <td> <?= $address['metro_station_name']; ?></td>
            <td> <?= $address['shop_address_phone']; ?></td>
            <td> <?= $address['shop_address_work_time']; ?></td>
            <td>
                <div class="form">
                    <a href="<?= SITE_ROOT . 'addresses/edit/' . $address['shop_address_id']; ?>" class="btn btn-warning mr-1">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-danger" onclick="deleteAddress(<?= $address['shop_address_id']; ?>, '<?= SITE_ROOT; ?>')">
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
