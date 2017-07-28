<h2><?= $viewAdminusers->login ?>
    <span>
        <?= \core\User::get()->returnIfAllowed("user/edit", 
            "<a href=" . \Url::link("user/edit&id=". $viewAdminusers->id) 
            . ">[Редактировать]</a>");?>
    </span>
</h2> 


<p class="pubDate">Зарегистрирован <?= $viewAdminusers->timestamp ?></p>
<p>Пароль: <?= $viewAdminusers->pass ?></p>
<p>E-mail: <?= $viewAdminusers->email ?></p>