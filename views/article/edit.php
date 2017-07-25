<h2><?= $editArticleTitle ?>
    <span>
        <a href="<?= \Url::link("article/delete&id=" . $_GET['id'])?>">
            [Удалить]</a>
    </span>
</h2>

<form method="post" action="<?= \Url::link("article/edit&id=" . $_GET['id'])?>">
    <h5>Введите название статьи</h5>
    <input type="text" name="title" value="<?= $viewArticle->title ?>"><br>
    <h5>Выберите категорию статьи</h5>
    <input type="text" name="categoryId" value="<?= $viewArticle->categoryId ?>"><br>
    <h5>Краткое описание статьи</h5>
    <textarea rows="5" cols="100" name="summary"><?= $viewArticle->summary ?></textarea><br>
    <h5>Текст статьи</h5>
    <textarea rows="20" cols="100" name="content"><?= $viewArticle->content ?></textarea><br>
    
    <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
    <input type="hidden" name="likes" value="<?= $viewArticle->likes; ?>">
    <input type="submit" name="saveChanges" value="Сохранить">
    <input type="submit" name="cancel" value="Назад">
</form>


<!--<h5>Дата публикации</h5>-->
    <!--<input type="text" name="title" value="<?= $viewArticle->publicationDate ?>"><br><br>-->