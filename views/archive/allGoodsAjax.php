<?php
foreach ($archiveGood['results'] as $k => $v):?>
    <h4>
        <a href="<?= \Url::link("admin/good/index&id=". $archiveGood['results'][$k]->id)?>">
            <?= $archiveGood['results'][$k]->name; ?>
        </a>
    </h4>
    <p>Цена товара: <?= $archiveGood['results'][$k]->price; ?> р.
     В наличии: <?= $archiveGood['results'][$k]->available; ?> штук</p>
    
   <?= \core\User::get()->returnIfAllowed("order/index", 
    "<form method='post' id='order-form' action='". \Url::link('order/manage'). "'>
        <input type='hidden' name='id_goods' value='" . $archiveGood['results'][$k]->id . "'>
        <input type='hidden' name='id_users' value='" . (new \core\Model)->getUserId() . "'>
        Количество: <input type='text' name='number' placeholder='0'>
        <input type='submit' name='addToTheOrder' value='Добавить в корзину' class='order'>
    </form>");?>
    
    <img src="/images/like1.png" height="20px" width="20px" data-modelId="<?= $archiveGood['results'][$k]->id?>" data-tableName='goods'>
        <span class="<?= $archiveGood['results'][$k]->id?>">
                <?= $archiveGood['results'][$k]->getModelLikes($archiveGood['results'][$k]->id, 'goods') ?>
        </span>
        <img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">
    <hr><br>    
<?php endforeach; ?>

