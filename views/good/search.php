<h2><?= $searchPageTitle ?></h2>



<form method='post' action='<?= \Url::link("goodSearch/index")?>'>
    <span>Наименование товара</span>
    <input type="text" name="name">
    <span>Описание товара</span>
    <input type="text" name="description">
    <span>В наличии на складе</span>
    <input type="text" name="available">
    <span>Цена товара</span>
    <input type="text" name="price">
    <span>Понравилось</span>
    <input type="text" name="likes">
</form>
<?php foreach ($searchGood['results'] as $k => $v):?>
    <h4>
        <a href="<?= \Url::link("admin/good/index&id=". $searchGood['results'][$k]->id)?>">
            <?= $searchGood['results'][$k]->name; ?>
        </a>
    </h4>
    <p>Цена товара: <?= $searchGood['results'][$k]->price; ?> р.
     В наличии: <?= $searchGood['results'][$k]->available; ?> штук</p>
    <img src="/images/like1.png" height="20px" width="20px" data-modelId="<?= $searchGood['results'][$k]->id?>" data-tableName='goods'>
    <span class="<?= $searchGood['results'][$k]->id?>">
        <?= $searchGood['results'][$k]->getModelLikes($searchGood['results'][$k]->id, 'goods') ?>
    </span>
    <img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">
    <hr><br>    
<?php endforeach; ?>

