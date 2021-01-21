<?php include_once('./views/templates/header.php'); ?>

<div class="container">
    <h1 class="mt-5 mb-4"><?= $article['article_name']; ?></h1>
    <p><b><?= $article['article_date']; ?></b></p>
    <div><?= htmlspecialchars_decode($article['article_content']); ?></div>

     
    <?php if (User::checkIfUserIsAdmin()) : ?>
    <div class="row mt-3">
        <a href="<?= SITE_ROOT . 'club/edit/' . $article['article_id']; ?>" class="btn btn-warning mr-3">Редактировать</a>
        <a class="btn btn-danger" onclick="deleteArticle(<?= $article['article_id']; ?>, '<?= SITE_ROOT; ?>')">Удалить</a>
    </div>
    <?php endif; ?>
</div>

<?php include_once('./views/templates/footer.php'); ?>
