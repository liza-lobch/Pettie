<?php include_once('./views/templates/header.php'); ?>
<h1 class="mt-4 mb-5"> <?php echo $h1 ?></h1>

<?php if (!User::checkIfUserIsAdmin()) : ?>
<div class="row">
    <?php foreach ($articles as $article): ?>
    <div class="card mb-4 article-card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <a href="<?= SITE_ROOT . 'club/view/' . $article['article_id'];?>"><img src="<?= IMG . 'club/preview_img/' . $article['article_img_preview'];?>" alt="<?= $article['article_name']; ?>" class="col-12"></a>
                </div>
                <div class="col-8">
                    <h5 class="card-title"><?= $article['article_name']; ?></h5>
                    <p class="card-text"><?= $article['article_preview_text']; ?></p>
                    <a href="<?= SITE_ROOT . 'club/view/' . $article['article_id'];?>" class="btn btn-primary btn-primary_article">Читать далее</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else : ?>
<a href="<?= SITE_ROOT . 'club/add' ?>" class="btn btn-primary mb-4"><i class="fa fa-plus "></i> Добавить статью</a>
<table class="table">
    <thead>
        <tr>
            <th>
                Название статьи
            </th>
            <th>
                Дата публикации
            </th>
            <th>
                Действия
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <a href="<?= SITE_ROOT . 'club/view/' . $article['article_id'];?>">
                    <?= $article['article_name']; ?>
                </a>
            </td>
            <td> <?= $article['article_date']; ?></td>
            <td>
                <div class="form">
                    <a href="<?= SITE_ROOT . 'club/edit/' . $article['article_id']; ?>" class="btn btn-warning mr-1">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-danger" onclick="deleteArticle(<?= $article['article_id']; ?>, '<?= SITE_ROOT; ?>')">
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
