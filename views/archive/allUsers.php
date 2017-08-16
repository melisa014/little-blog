<h2><?= $archivePageTitle ?></h2>

<?php 
foreach ($archiveAdminusers['results'] as $k => $v):?>
    <h4>
        <a href="<?= \core\mvc\view\Url::link("admin/adminusers/index&id=". $archiveAdminusers['results'][$k]->id)?>">
            <?= $archiveAdminusers['results'][$k]->login; ?>
        </a>
        Зарегистрирован: <?= $archiveAdminusers['results'][$k]->timestamp; ?>
    </h4>
    <hr><br>    
<?php endforeach; ?>
