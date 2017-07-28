
<h2><?= $addAdminusersTitle ?></h2>

<form method="post" action="<?= \Url::link("admin/adminusers/add")?>"> 
    <h5>Введите имя пользователя</h5>
    <input type="text" name="login" value="*имя пользователя*"><br>
    <h5>Введите пароль</h5>
    <input type="text" name="pass" value="*пароль*"><br>
    <h5>Введите e-mail</h5>
    <input type="text" name="email" value="*email*"><br>
    <input type="submit" name="saveNewUser" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

