<?php

use ItForFree\rusphp\PHP\ArrayLib\Merger;
use ItForFree\SimpleMVC\Application;
/**
 * Запуск приложения
 */

require_once("autoload.php"); // автозагрузка классов
/**
 * Получение массива конфигурации
 */
$localConfig = require(__DIR__ . '/../application/config/web-local.php');
$config = Merger::mergeRecursivelyWithReplace(
    require(__DIR__ . '/../application/config/web.php'), 
    $localConfig);

Application::get()
    ->setConfiguration($config)
    ->run();    

