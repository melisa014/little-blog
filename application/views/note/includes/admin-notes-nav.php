<?php 
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');


//vpre($User->explainAccess("admin/adminusers/index"));
?>

<ul class="nav">
    
    <?php  if ($User->isAllowed("admin/notes/index")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/notes/index") ?>">Список</a>
    </li>
    <?php endif; ?>
    
    <?php  if ($User->isAllowed("admin/notes/add")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/notes/add") ?>"> + Добавить заметку</a>
    </li>
    <?php endif; ?>  
</ul>