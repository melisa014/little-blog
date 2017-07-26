<h2><?= $addCategoryTitle ?></h2>

<form method="post" action="<?= \Url::link("category/add")?>"> <!--&id=<?php echo $_GET['id']; ?>-->
    <h5>Введите название категории</h5>
    <input type="text" name="name" value="*название категории*"><br>
    <h5>Краткое описание категории</h5>
    <textarea rows="5" cols="100" name="description">*краткое описание*</textarea><br>
    <input type="submit" name="saveNewCategory" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

