<?php

use ItForFree\rusphp\PHP\ArrayLib\Merger;
use ItForFree\SimpleMVC\Application;
use ItForFree\SimpleMVC\ExceptionHandler;
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

$exceptionHandler = new ExceptionHandler();

try {
Application::get()
    ->setConfiguration($config)
    ->run();    
} catch (Exception $exc) {
    $exceptionHandler->displayException($exc);
//    throw $exc;
}

