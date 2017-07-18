
<form method="post" action="http://little-blog/index.php?action=article/add&id=<?php echo $_GET['id']; ?>">
    <h5>Введите название статьи</h5>
    <input type="text" name="title" value=""><br>
    <h5>Выберите категорию статьи</h5>
    <input type="text" name="category" value=""><br>
    <h5>Краткое описание статьи</h5>
    <textarea rows="5" cols="100" name="summary" value=""></textarea><br>
    <h5>Текст статьи</h5>
    <textarea rows="20" cols="100" name="content" value=""></textarea><br>
    <h5>Дата публикации</h5>
    <input type="text" name="title" value="<?php date('d M Y H:i:s') ?>"><br><br>
    <input type="submit" name="ok" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

