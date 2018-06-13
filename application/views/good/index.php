<h2><?= $viewGood->name ?>
    <span>
        <?= \ItForFree\SimpleMVC\User::get()->returnIfAllowed("admin/good/edit", 
            "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/good/edit&id=". $viewGood->id) 
            . ">[Редактировать]</a>");?>
    </span>
</h2> 

<!-- Вывод картинок-->
    <?php
    $images = (new \application\models\Image())->getImagesPathByGoodId($viewGood->id);
    foreach ($images as $path) {
        echo "<img src='uploads/" . $path['path'] ."' height='200px'>";
    } ?>

<p>Описание: <?= $viewGood->description; ?></p>
<p>Цена: <?= $viewGood->price; ?>р.</p> 
<p>В наличии:  <?= $viewGood->available; ?> шт.</p>
<img src="/images/like.png" height="20px" width="20px" data-modelId="<?= $viewGood->id ?>" data-tableName='goodss'>
<span class="<?= $viewGood->id?>">
    <?= $viewGood->getModellikes($viewGood->id, 'goods') ?>
</span>
<img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">