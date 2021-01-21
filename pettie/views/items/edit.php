<?php include_once('./views/templates/header.php'); ?>
<div class="container">
    <?php if (isset($errors) && !empty($errors)): ?>
    <div>
        <?php foreach ($errors as $error): ?>
        <p class="error"> <?= $error; ?> </p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data" action="">
        <div class="form-group">
            <label>Наименование</label>
            <input type="text" class="form-control" name="item_name" value="<?= isset($_POST['item_name']) ? $_POST['item_name'] : $item['item_name']; ?>">
        </div>
        <div class="form-group">
            <label>Тип животного</label>
            <select class="form-control" name="item_animal_type">
                <?php foreach ($animal_types as $animal_type): ?>
                <option value="<?= $animal_type['animal_type_id']; ?>" <?= (isset($_POST['item_animal_type'])) ? (($animal_type['animal_type_id'] == $_POST['item_animal_type']) ? "selected" : "") 
                    : (($animal_type['animal_type_id'] == $item['item_animal_type_id']) ? "selected" : ""); ?>>
                    <?=  $animal_type['animal_type_name']; ?>
                </option>
                <?php endforeach ; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Артикул</label>
            <input type="text" class="form-control" name="item_vendor_code" value="<?= isset($_POST['item_vendor_code']) ? $_POST['item_vendor_code']: $item['item_vendor_code']; ?>">
        </div>
        <div class="form-group">
            <label>Объем</label>
            <input type="text" class="form-control" name="item_unit_count" value="<?= isset($_POST['item_unit_count']) ? $_POST['item_unit_count']: $item['item_unit_count']; ?>">

            <select class="form-control" name="item_unit">
                <?php foreach ($units as $unit): ?>
                <option value="<?= $unit['unit_id']; ?>" <?= (isset($_POST['item_unit'])) ? (($unit['unit_id'] == $_POST['item_unit']) ? "selected" : "") 
                    : (($unit['unit_id'] == $item['item_unit_id']) ? "selected" : ""); ?>>
                    <?=  $unit['unit_name']; ?>
                </option>
                <?php endforeach ; ?>
            </select>
        </div>
        <div class="form-group">
            <label>В наличии</label>
            <input type="text" class="form-control" name="item_count" value="<?= isset($_POST['item_count']) ? $_POST['item_count']: $item['item_count']; ?>">
        </div>
        <div class="form-group">
            <label>Производитель</label>
            <select class="form-control" name="item_manufacturer">
                <?php foreach ($manufacturers as $manufacturer): ?>
                <option value="<?= $manufacturer['manufacturer_id']; ?>" <?= (isset($_POST['item_manufacturer'])) ? (($manufacturer['manufacturer_id'] == $_POST['item_manufacturer']) ? "selected" : "") 
                    : (($manufacturer['manufacturer_id'] == $item['item_manufacturer_id']) ? "selected" : ""); ?>>
                    <?=  $manufacturer['manufacturer_name']; ?>
                </option>
                <?php endforeach ; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Категория</label>
            <select class="form-control" name="item_category">
                <?php foreach ($categories as $category): ?>
                <option value="<?= $category['category_id']; ?>" <?= (isset($_POST['item_category'])) ? (($category['category_id'] == $_POST['item_category']) ? "selected" : "") 
                    : (($category['category_id'] == $item['item_category_id']) ? "selected" : ""); ?>>
                    <?=  $category['category_name']; ?>
                </option>
                <?php endforeach ; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Состав</label>
            <input type="text" class="form-control" name="item_structure" value="<?= isset($_POST['item_structure']) ? $_POST['item_structure']: $item['item_structure']; ?>">
        </div>
        <div class="form-group">
            <label>Описание</label>
            <input type="text" class="form-control" name="item_desc" value="<?= isset($_POST['item_desc']) ? $_POST['item_desc']: $item['item_desc']; ?>">
        </div>
        <div class="form-group">
            <label>Цена</label>
            <input type="text" class="form-control" name="item_price" value="<?= isset($_POST['item_price']) ? $_POST['item_price']: $item['item_price']; ?>">
        </div>

        <div class="form-group">
            <label>Картинка товара при предпросмотре: </label>
            <input type="file" name="item_img_preview" id="item_img_preview" accept="image/png,image/jpg,image/jpeg,image/gif">
            <p>*Если вы не собираетесь изменять картинку, оставьте это поле пустым.</p>
        </div>
        <div class="form-group">
            <label>Основная картинка товара: </label>
            <input type="file" name="item_img_main" id="item_img_preview" accept="image/png,image/jpg,image/jpeg,image/gif">
            <p>*Если вы не собираетесь изменять картинку, оставьте это поле пустым.</p>
        </div>



        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>
<?php include_once('./views/templates/footer.php'); ?>
