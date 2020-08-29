
<?php

?>
<div class="card-header"><h1><?= $status?></h1> <?=$message?></div>
<div class="card-body">
    <table class="table table-striped table-dark">
    <?php foreach ($trace as $key=>$value):?> 
        <tr>
            <td><?=$value['file']?></td>
            <td width="10%"><?=$value['line']?></td>
            <td><?=$value['function']?></td>
            <td><?=$value['class']?></td>
        </tr>
    <?php endforeach;?>
    </table>
</div>


