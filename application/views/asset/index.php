<?php
use application\models\TestAsset;
use ItForFree\SimpleMVC\components\SimpleAsset\SimpleAssetManager;

TestAsset::add();
?>

<div class="row">
    <div class="col "><h1><?php echo $homepageTitle ?></h1>
        </div>
</div>
<div class="row">
    <div class="col ">
      <p class="lead"> Тестируем... </p>
      <pre><?php SimpleAssetManager::printJs()  ?></pre>
    </div>
</div>