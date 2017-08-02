<h2><?= $viewGood->name ?>
    <span>
        <?= \core\User::get()->returnIfAllowed("admin/good/edit", 
            "<a href=" . \Url::link("admin/good/edit&id=". $viewGood->id) 
            . ">[Редактировать]</a>");?>
    </span>
</h2> 

<p>Описание: <?= $archiveGood['results'][$k]->description; ?></p>
<p>Цена: <?= $archiveGood['results'][$k]->price; ?></p>
<p>В наличии:  <?= $archiveGood['results'][$k]->available; ?> шт.</p>
<img src="/images/like1.png" height="20px" width="20px" data-articleId="<?= $viewGood->id ?>">
<span class="<?= $viewGood->id?>">
    <?= $viewGood->getArticlelikes($viewGood->id) ?>
</span>
<img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">