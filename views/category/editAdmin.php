<h2><?php echo $editCategoryTitle ?>
    <span>
        <a href="<?php Url::link("category/delete&id=". $_GET['id']) ?>"
            [Удалить]</a>
    </span>
</h2>

<form method="post" action="<?php Url::link("category/edit&id=" . $_GET['id']) ?>"
    <h5>Введите название категории</h5>
    <input type="text" name="name" value="<?php echo $viewCategory->name ?>"><br>
    <h5>Краткое описание категории</h5>
    <textarea rows="5" cols="100" name="summary"><?php echo $viewCategory->description ?></textarea><br>
    <input type="submit" name="saveChanges" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

