<h2><?= $deleteGoodTitle ?></h2>

<form method="post" action="<?= \core\mvc\view\Url::link("admin/good/delete&id=". $_GET['id'])?>" >
    Вы уверены, что хотите удалить данный товар?
    
    <input type="hidden" name="id" value="<?= $deletedGood->id ?>">
    <input type="submit" name="deleteGood" value="Удалить">
    <input type="submit" name="cancel" value="Вернуться"><br>
</form>
