<?php if ($_GET('action') = 'addArticle') : ?>
    <h2>Создание новой статьи</h2>
<?php endif; ?>
<?php if ($_GET('action') = 'editArticle') : ?>
    <h2>Редактирование статьи</h2>
<?php endif; ?>


<form method="post" action="editArticle.php">
    <input type="text" name="title" value=""><br>
    <input type="text" name="category" value=""><br>
    <input type="textarea" name="summary" value=""><br>
    <input type="textarea" name="content" value=""><br>
    <input type="text" name="title" value="<?php date('d M Y H:i:s') ?>"><br>
    <input type="submit" name="ok" value="Сохранить"><br>
</form>>


