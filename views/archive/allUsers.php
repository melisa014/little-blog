<h2><?= $archivePageTitle ?></h2>

<?php 
foreach ($archiveAdminusers['results'] as $k => $v):?>
    
    <a href="<?= \Url::link("user/index&id=". $archiveAdminusers['results'][$k]->id)?>">
        <h4><?= $archiveAdminusers['results'][$k]->login; ?></h4>
    </a>
    <!--<p><?= $archiveAdminusers['results'][$k]->email; ?></p>-->
    <p><?= $archiveAdminusers['results'][$k]->timestamp; ?></p>
    <hr><br>    
<?php endforeach; ?>
