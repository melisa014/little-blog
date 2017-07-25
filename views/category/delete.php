<h2><?php echo $deleteCategoryTitle ?></h2>

<form method="post" action="<?= \Url::link("category/delete&id=". $_GET['id'])?>" >
    Вы уверены, что хотите удалить категорию?
    <input type="hidden" name="article" value="<?= $deleteArticle ?>">
    <input type="submit" name="deleteCategory" value="Удалить">
    <input type="submit" name="cancel" value="Вернуться"><br>
</form>

