<?php include_once('./views/templates/header.php'); ?>

<?php if ($cartString === ""): ?>
<h3> Ваша корзина пуста</h3>
<?php else: ?>
<div class="row mt-4">
    <?php if (isset($errors) && !empty($errors)): ?>
    <div>
        <?php foreach ($errors as $error): ?>
        <p class="error"> <?= $error; ?> </p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
<div class="form">
    <div class="row mt-3">
        <form method="POST">
            <div class="form-group">
                <label>Имя</label>
                <input type="text" class="form-control" name="user_name" value="<?= isset($_POST['user_name']) ? $_POST['user_name'] : (isset($userInfo) ? $userInfo['user_first_name'] : ""); ?>">
            </div>
            <div class="form-group">
                <label>Телефон</label>
                <input type="text" class="form-control" name="user_phone" value="<?= isset($_POST['user_phone']) ? $_POST['user_phone'] : (isset($userInfo) ? $userInfo['user_phone'] : ""); ?>">
            </div>
            <div class="form-group">
                <label>Адрес</label>
                <input type="text" class="form-control" name="user_address" value="<?= isset($_POST['user_address']) ? $_POST['user_address'] : (isset($userInfo) ? $userInfo['address_name'] : ""); ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="user_email" value="<?= isset($_POST['user_email']) ? $_POST['user_email'] : (isset($userInfo) ? $userInfo['user_email'] : ""); ?>">
            </div>
            <div>
                <p><input type="checkbox" name="user_agreement" checked> Я согласен на <a href="<?= SITE_ROOT . 'agreement' ?>" target="_blank">обработку персональных данных</a></p>
            </div>
            <div class="row mt-5 mb-4 btn-center">
                <button type="submit" class="btn btn-primary">Заказать</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<?php include_once('./views/templates/footer.php'); ?>
