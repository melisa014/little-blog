<h2><?php echo $deleteArticleTitle ?></h2>

<form method="post" action="/index.php?action=article/delete&id=<?php echo $_GET['id']; ?>" >
    Вы уверены, что хотите удалить статью?
    <input type="submit" name="deleteArticle" value="Удалить">
    <input type="submit" name="cancel" value="Вернуться"><br>
</form>
