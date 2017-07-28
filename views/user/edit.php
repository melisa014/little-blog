<h2><?= $editAdminusersTitle ?>
    <span>
        <?= \core\User::get()->returnIfAllowed("admin/adminusers/delete", 
            "<a href=" . \Url::link("admin/adminusers/delete&id=" . $_GET['id']) 
            . ">[Удалить]</a>");?>
    </span>
</h2>

<form method="post" action="<?= \Url::link("admin/adminusers/edit&id=" . $_GET['id'])?>">
    <h5>Введите имя пользователя</h5>
    <input type="text" name="login" value="<?= $viewAdminusers->login ?>"><br>
    <h5>Введите пароль</h5>
    <input type="text" name="pass" value="<?= $viewAdminusers->pass ?>"><br>
    <h5>Введите e-mail</h5>
    <input type="text" name="email" value="<?= $viewAdminusers->email ?>"><br>
    
    <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
    <input type="submit" name="saveChanges" value="Сохранить">
    <input type="submit" name="cancel" value="Назад">
</form>
