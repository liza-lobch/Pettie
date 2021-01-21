<?php include_once('./views/templates/header.php'); ?>
<div class="mt-5 mb-5">
    <?php if (isset($errors) && !empty($errors)): ?>
    <div class="errors">
        <?php foreach ($errors as $error): ?>
        <p class="error"> <?= $error; ?> </p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <div class="form">
        <div class="row">
            <form method="POST">
                <div class="form-group mb-5">
                    <p class="text-center">Уже зарегистрированы? <a href="<?= SITE_ROOT . 'auth' ?>">Войти</a></p>
                </div>
                <div class="form-group">
                    <label>Логин</label>
                    <input type="text" class="form-control" name="user_login" id="user_reg" value="<?= isset($_POST['user_login']) ? $_POST['user_login'] : ""; ?>">
                    <div id="login_helper" class=" warning"></div>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" class="form-control" name="user_password" id="user_password_reg" value="<?= isset($_POST['user_password']) ? $_POST['user_password']: ""; ?>">
                    <div id="password_helper" class=" warning"></div>
                </div>
                <div class="form-group">
                    <label>Повторите пароль</label>
                    <input type="password" class="form-control" name="user_password_repeat" id="user_password_repeat" value="<?= isset($_POST['user_password_repeat']) ? $_POST['user_password_repeat']: ""; ?>">
                    <div id="password_repeat_helper" class=" warning"></div>
                </div>
                <div>
                    <p><input type="checkbox" name="user_agreement" checked> Я согласен на <a href="<?= SITE_ROOT . 'agreement' ?>" target="_blank">обработку персональных данных</a></p>
                </div>
                <div class="btn-center">
                    <button type="submit" class="btn btn-primary btn-center">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once('./views/templates/footer.php'); ?>
