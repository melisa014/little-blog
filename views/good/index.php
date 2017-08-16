<h2><?= $viewGood->name ?>
    <span>
        <?= \core\User::get()->returnIfAllowed("admin/good/edit", 
            "<a href=" . \core\mvc\view\Url::link("admin/good/edit&id=". $viewGood->id) 
            . ">[Редактировать]</a>");?>
    </span>
</h2> 

<p>Описание: <?= $viewGood->description; ?></p>
<p>Цена: <?= $viewGood->price; ?>р.</p> 
<p>В наличии:  <?= $viewGood->available; ?> шт.</p>
<img src="/images/like1.png" height="20px" width="20px" data-modelId="<?= $viewGood->id ?>" data-tableName='goodss'>
<span class="<?= $viewGood->id?>">
    <?= $viewGood->getModellikes($viewGood->id, 'goods') ?>
</span>
<img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">