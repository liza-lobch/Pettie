<?php include_once('./views/templates/header.php'); ?>
<div class="container">
    <?php if (isset($errors) && !empty($errors)): ?>
    <div>
        <?php foreach ($errors as $error): ?>
        <p class="error"> <?= $error; ?> </p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label>Адрес</label>
            <input type="text" class="form-control" name="address_name" value="<?= isset($_POST['address_name']) ? $_POST['address_name'] : $address['shop_address_name']; ?>">
        </div>

        <div class="form-group">
            <label>Станция метро</label>
            <select class="form-control" name="metro_station">
                <?php foreach ($metro_stations as $metro_station): ?>
                <option value="<?= $metro_station['metro_station_id']; ?>" <?= (isset($_POST['metro_station'])) ? (($metro_station['metro_station_id'] == $_POST['metro_station']) ? "selected" : "") 
                    : (($metro_station['metro_station_id'] == $address['shop_address_metro_station_id']) ? "selected" : ""); ?>>
                    <?=  $metro_station['metro_station_name']; ?>
                </option>
                <?php endforeach ; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Телефон</label>
            <input type="text" class="form-control" name="address_phone" value="<?= isset($_POST['address_phone']) ? $_POST['address_phone']: $address['shop_address_phone']; ?>">
        </div>

        <div class="form-group">
            <label>Рабочее время</label>
            <input type="text" class="form-control" name="work_time" value="<?= isset($_POST['work_time']) ? $_POST['work_time']: $address['shop_address_work_time']; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>
<?php include_once('./views/templates/footer.php'); ?>
