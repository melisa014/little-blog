<h2><?= $searchPageTitle ?></h2>



<form action='<?= \core\mvc\view\Url::link("goodSearch/index")?>'>
    <span>Наименование товара</span>
    <input type="text" name="name" placeholder="введите название товара">
    <span>Количество</span>
    <input type="text" name="available" placeholder="сколько единиц товара требуется">
    <span>Цена товара</span>
    <input type="text" name="price_from" placeholder="от" >
    <input type="text" name="price_to"   placeholder="до">
    <input type='submit' name='search' value='Поиск'>
    <input type='hidden' name='route' value='goodSearch/index'>
</form>
<?php

if (!empty($_GET['total'])) {
    echo "По Вашему запросу товаров не найдено";
}
else {
    echo "Найдено " . $searchGood['totalRows'] . ": <br>"; 

    foreach ($searchGood['results'] as $k => $v):?>
        <h4>
            <a href="<?= \core\mvc\view\Url::link("admin/good/index&id=". $searchGood['results'][$k]->id)?>">
                <?= $searchGood['results'][$k]->name; ?>
            </a>
        </h4>

        <!-- Вывод картинок-->
        <?php
        $images = (new \application\models\Image())->getImagesPathByGoodId($searchGood['results'][$k]->id);
        foreach ($images as $path) {
            echo "<img src='uploads/" . $path['path'] ."' height='200px'>";
        } ?>
        
        <p>Цена товара: <?= $searchGood['results'][$k]->price; ?> р.
         В наличии: <?= $searchGood['results'][$k]->available; ?> штук</p>
        <img src="/images/like.png" height="20px" width="20px" data-modelId="<?= $searchGood['results'][$k]->id?>" data-tableName='goods'>
        <span class="<?= $searchGood['results'][$k]->id?>">
            <?= $searchGood['results'][$k]->getModelLikes($searchGood['results'][$k]->id, 'goods') ?>
        </span>
        <img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">
        <hr><br>    
    <?php endforeach; 
}?>
