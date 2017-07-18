
<form method="post" action="http://little-blog/index.php?action=article/edit&id=<?php echo $_GET['id']; ?>">
    <h5>Введите название статьи</h5>
    <input type="text" name="title" value="<?php echo $viewArticleTitle ?>"><br>
    <h5>Выберите категорию статьи</h5>
    <input type="text" name="category" value="<?php echo $viewArticleCategoryId ?>"><br>
    <h5>Краткое описание статьи</h5>
    <textarea rows="5" cols="100" name="summary"><?php echo $viewArticleSummary ?></textarea><br>
    <h5>Текст статьи</h5>
    <textarea rows="20" cols="100" name="content"><?php echo $viewArticleContent ?></textarea><br>
    <h5>Дата публикации</h5>
    <input type="text" name="title" value="<?php echo $viewArticleDate ?>"><br><br>
    <input type="submit" name="ok" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>
<a href="http://little-blog/index.php?action=article/delete&id=<?php echo $viewArticleId; ?>">
    [Удалить]</a>
