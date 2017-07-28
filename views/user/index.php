<h2><?= $viewAdminusers->login ?>
    <span>
        <?= \core\User::get()->returnIfAllowed("admin/adminusers/edit", 
            "<a href=" . \Url::link("admin/adminusers/edit&id=". $viewAdminusers->id) 
            . ">[Редактировать]</a>");?>
    </span>
</h2> 


<p>Зарегистрирован <?= $viewAdminusers->timestamp ?></p>
<p>Пароль: <?= $viewAdminusers->pass ?></p>
<p>E-mail: <?= $viewAdminusers->email ?></p>