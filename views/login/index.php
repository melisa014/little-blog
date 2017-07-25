<h2><?= $loginTitle ?></h2>

<form method="post" action="<?= \Url::link('login/index')?>">
    <h5>Введите имя пользователя</h5>
    <input type="text" name="userName" value=""><br>
    <h5>Введите пароль</h5>
    <input type="password" name="password" value=""><br>
    <input type="submit" name="login" value="Войти">
</form>

