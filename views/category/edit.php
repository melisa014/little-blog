<h2><?= $editCategoryTitle ?>
    <span>
        <?= \core\User::get()->returnIfAllowed("category/delete", 
            "<a href=" . \core\mvc\view\Url::link("category/delete&id=" . $_GET['id']) 
            . ">[Удалить]</a>");?>
    </span>
</h2>

<form method="post" action="<?= \core\mvc\view\Url::link("category/edit&id=" . $_GET['id']) ?>"
    <h5>Введите название категории</h5>
    <input type="text" name="name" value="<?= $viewCategory->name ?>"><br>
    <h5>Краткое описание категории</h5>
    <textarea rows="5" cols="100" name="description"><?= $viewCategory->description ?></textarea><br>
    
    <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
    <input type="submit" name="saveChanges" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

