<h2><?php echo $editArticleTitle ?>
    <span>
        <a href="/index.php?action=article/delete&id=<?= $_GET['id']; ?>">
            [Удалить]</a>
    </span>
</h2>

<form method="post" action="/index.php?action=article/edit&id=<?php echo $_GET['id']; ?>">
    <h5>Введите название статьи</h5>
    <input type="text" name="title" value="<?php echo $viewArticle->title ?>"><br>
    <h5>Выберите категорию статьи</h5>
    <input type="text" name="category" value="<?php echo $viewArticle->categoryId ?>"><br>
    <h5>Краткое описание статьи</h5>
    <textarea rows="5" cols="100" name="summary"><?php echo $viewArticle->summary ?></textarea><br>
    <h5>Текст статьи</h5>
    <textarea rows="20" cols="100" name="content"><?php echo $viewArticle->content ?></textarea><br>
    <h5>Дата публикации</h5>
    <input type="text" name="title" value="<?php echo $viewArticle->publicationDate ?>"><br><br>
    <input type="submit" name="saveChanges" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

