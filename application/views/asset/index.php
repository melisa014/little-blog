<?php
use application\models\TestAsset;
use ItForFree\SimpleAsset\SimpleAssetManager;
//use  ItForFree\SimpleMVC\components\SimpleAsset\SimpleAssetManager;

TestAsset::add();
?>

<div class="row">
    <div class="col "><h1><?php echo $homepageTitle ?></h1>
        </div>
</div>
<div class="row">
    <div class="col ">
      <p class="lead"> Тестируем... </p>
      Js:
      <pre><?php SimpleAssetManager::printJs()  ?></pre>
      Css:
      <pre><?php SimpleAssetManager::printCss()  ?></pre>
    </div>
</div>