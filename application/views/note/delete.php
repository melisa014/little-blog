<?php 
use ItForFree\SimpleMVC\Config;

$Url = Config::getObject('core.url.class');
?>

<?php include('includes/admin-notes-nav.php'); ?>

<h2><?= $deleteNotesTitle ?></h2>

<form method="post" action="<?= $Url::link("admin/notes/delete&id=". $_GET['id'])?>" >
    Вы уверены, что хотите удалить заметку?
    
    <input type="hidden" name="id" value="<?= $deletedNotes->id ?>">
    <input type="submit" name="deleteNote" value="Удалить">
    <input type="submit" name="cancel" value="Вернуться"><br>
</form>