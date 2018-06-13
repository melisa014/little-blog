<?php
foreach ($archiveGood['results'] as $k => $v):?>
    <h4>
        <a href="<?= \ItForFree\SimpleMVC\Url::link("admin/good/index&id=". $archiveGood['results'][$k]->id)?>">
            <?= $archiveGood['results'][$k]->name; ?>
        </a>
    </h4>

    <!-- Вывод картинок-->
    <?php
    $images = (new \application\models\Image())->getImagesPathByGoodId($archiveGood['results'][$k]->id);
    foreach ($images as $path) {
        echo "<img src='uploads/" . htmlspecialchars($path['path']) ."' height='200px'>";
    } ?>

    <p>Цена товара: <?= $archiveGood['results'][$k]->price; ?> р.
    В наличии: <span id="available-<?=$archiveGood['results'][$k]->id?>"><?= $archiveGood['results'][$k]->available; ?></span> шт.</p>
    <div id="notAvaliable-<?=$archiveGood['results'][$k]->id?>" style='color: red'></div>
    
    <?= \ItForFree\SimpleMVC\User::get()->returnIfAllowed("order/index", 
    "<form method='post' id='form-" . $archiveGood['results'][$k]->id . "'>
        <input type='hidden' name='id_goods' value='" . $archiveGood['results'][$k]->id . "'>
        <input type='hidden' name='id_users' value='" . (new \ItForFree\SimpleMVC\mvc\Model)->getUserId() . "'>
        Количество: <input type='text' name='number' placeholder='0'>
        <input type='submit' name='addToTheOrder' value='Добавить в корзину' class='goods' data-good-id='" . $archiveGood['results'][$k]->id . "'>
    </form>");?>
    
    <img src="/images/like.png" height="20px" width="20px" data-modelId="<?= $archiveGood['results'][$k]->id?>" data-tableName='goods'>
        <span class="<?= $archiveGood['results'][$k]->id?>">
                <?= $archiveGood['results'][$k]->getModelLikes($archiveGood['results'][$k]->id, 'goods') ?>
        </span>
        <img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">
    <hr><br>    
<?php endforeach; ?>

