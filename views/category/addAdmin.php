<h2><?php echo $addCategoryTitle ?></h2>

<form method="post" action="/index.php?action=category/add"> <!--&id=<?php echo $_GET['id']; ?>-->
    <h5>Введите название категории</h5>
    <input type="text" name="name" value="*название категории*"><br>
    <h5>Краткое описание категории</h5>
    <textarea rows="5" cols="100" name="summary">*краткое описание*</textarea><br>
    <input type="submit" name="saveNewCategory" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

