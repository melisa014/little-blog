<?php

require_once("autoload.php"); // автозагрузка классов

$localConfig = require(__DIR__ . '/../application/config/web-local.php');
$config = ItForFree\rusphp\PHP\ArrayLib\Merger::mergeRecursivelyWithReplace(
    require(__DIR__ . '/../application/config/web.php'), 
    $localConfig);

require_once("../application/bootstrap.php");


\ItForFree\SimpleMVC\Application::get()
    ->setConfiguration($config)
    ->run();
