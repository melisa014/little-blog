<h2><?= $orderTitle ?></h2> 

<!-- <?= \DebugPrinter::debug($viewOrder); ?> -->
<?php
$allGoodsCount = (new \application\models\Correction())->getUsersAllGoodsCount();
if ( $allGoodsCount > 0) { ?>
    <table>
    <tr>
        <th>Товар</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Стоимость</th>
        <th>Удалить из заказа</th>
    </tr>
    
    <?php
    $total = 0;
    foreach ($viewOrder as $good) : ?>
    <tr>
        <td><?= $good->name ?></td>
        <td><?= $price = $good->price ?></td>
        <td><?php 
            $countGood = (new \application\models\Correction())->getUsersGoodCount($good->id);
//                \DebugPrinter::debug($count);
            $count = $countGood['number'];
            echo "$count";
        ?></td>
        <td><?= $cost = $price * $count ?></td>
        <td>
            <form method="post" action="<?= \Url::link('order/index')?>">
                <input type="submit" name="deleteFromOrder" value="X">
                <input type="hidden" name="goodId" value="<?= $good->id ?>">
            </form>
        </td>
    </tr>
    <?php 
    $total += $cost;
    endforeach; ?>
        
    </table>
    <h4>Полная стоимость Вашего заказа: <?= $total ?> р.</h4>
    <form method="post" action="<?= \Url::link('order/index')?>">
        <input type="submit" name="approveOrder" value="Подтвердить">
        <input type="submit" name="closeOrder" value="Отменить заказ">
    </form>

<?php } 
else { ?>
    <h4>Нет зарезервированных товаров</h4>
    
<?php } ?>






