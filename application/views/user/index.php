<?php 
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>

<h2>Пользователи</h2> 
    
<?php if (!empty($users)): ?>
    <?php foreach($users as $user): ?>
    <p>Логин: <?= $user->login ?> </p>
    <p>Зарегистрирован <?= $user->timestamp ?></p>
    <p>E-mail: <?= $user->email ?></p>
            <?= $User->returnIfAllowed("admin/adminusers/edit", 
                "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/adminusers/edit&id=". $user->id) 
                . ">[Редактировать данные пользователя]</a>");?>
        <hr>
    <?php endforeach; ?>
<?php else:?>
    <p> Список пользователей пуст. </p>
<?php endif; ?>