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
            <label>Заголовок статьи</label>
            <input type="text" class="form-control" name="article_name" value="<?= isset($_POST['article_name']) ? $_POST['article_name'] : $article['article_name']; ?>">
        </div>        
        
        <div class="form-group">
            <label>Текст предпросмотра</label>
            <input type="text" class="form-control" name="article_preview_text" value="<?= isset($_POST['article_preview_text']) ? $_POST['article_preview_text']: $article['article_preview_text']; ?>">
        </div>
        
        <div class="form-group">
            <label>Описание</label>
            <textarea class="form-control" name="article_content" cols="130" rows="10" rows="3"><?= isset($_POST['article_content']) ? $_POST['article_content']: htmlspecialchars_decode($article['article_content']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Картинка статьи при предпросмотре: </label>
            <input type="file" name="article_img_preview" id="article_img_preview" accept="image/png,image/jpg,image/jpeg,image/gif">
            <p>*Если вы не собираетесь изменять картинку, оставьте это поле пустым.</p>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
  </div>
<?php include_once('./views/templates/footer.php'); ?>