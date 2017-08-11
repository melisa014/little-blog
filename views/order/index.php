<h2><?= $orderTitle ?></h2> 

<!-- <?= \DebugPrinter::debug($viewOrder); ?> -->
<table>
    <tr>
        <th>Товар</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Стоимость</th>
    </tr>
    
        <?php
        $total = 0;
        foreach ($viewOrder as $good) : ?>
        <tr>
            <td><?= $good->name ?></td>
            <td><?= $price = $good->price ?></td>
            <td><?= $count = (new \application\models\Correction())->getUsersGoodsCount($good->id) ?></td>
            <td><?= $cost = $price * $count ?></td>
        </tr>
        <?php 
        $total += $cost;
        endforeach; ?>
        
</table>
Полная стоимость Вашего заказа: <?= $total ?>





