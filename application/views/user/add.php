
<h2><?= $addAdminusersTitle ?></h2>

<form id="addUser" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/adminusers/add")?>"> 
    <h5>Введите имя пользователя</h5>
    <input type="text" name="login" placeholder="имя пользователя"><br>
    <h5>Введите пароль</h5>
    <input type="text" name="pass" placeholder="пароль"><br>
       
    <h5>Права доступа</h5>
    <select name="role"> 
        <option value="admin">Администратор</option>
        <option value="auth_user">Зарегистрированный пользователь</option>
    </select>
    
    <h5>Введите e-mail</h5>
    <input type="text" name="email" placeholder="адрес электропочты"><br>
    <input type="submit" name="saveNewUser" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

