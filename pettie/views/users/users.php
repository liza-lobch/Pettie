<?php include_once('./views/templates/header.php'); ?>
<?php if (!User::checkIfUserIsAdmin()) : ?>
<div class="container">
    <h1>Ошибка</h1>
    <p>Что-то пошло не так...</p>
</div>
<?php else : ?>
<h1 class="mt-4 mb-5"><?php echo $h1 ?></h1>

<table class="table">
    <thead>
        <tr>
            <th>
                Логин
            </th>
            <th>
                Имя
            </th>
            <th>
                Телефон
            </th>
            <th>
                Адрес
            </th>
            <th>
                Email
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= (!$user['user_login'] == "") ? $user['user_login'] : "&mdash"; ?></td>
            <td><?= (!$user['user_first_name'] == "") ? $user['user_first_name'] : "—"; ?></td>
            <td><?= (!$user['user_phone'] == "") ? $user['user_phone'] : "—"; ?></td>
            <td><?= (!$user['address_name'] == "") ? $user['address_name'] : "—"; ?></td>
            <td><?= (!$user['user_email'] == "") ? $user['user_email'] : "—"; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
<?php include_once('./views/templates/footer.php'); ?>




