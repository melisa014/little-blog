<?php
use ItForFree\SimpleMVC\Application;
use ItForFree\rusphp\Log\SimpleEchoLog;

require_once("autoload.php"); // автозагрузка классов

//phpinfo(); die();

//$route = \ItForFree\SimpleMVC\Url::getRoute();
//$obj = new \ItForFree\SimpleMVC\Router($route);


$localConfig = require(__DIR__ . '/../application/config/web-local.php');
$config = ItForFree\rusphp\PHP\ArrayLib\Merger::mergeRecursivelyWithReplace(
    require(__DIR__ . '/../application/config/web.php'), 
    $localConfig);


\ItForFree\SimpleMVC\Application::get()
    ->setConfiguration($config)
    ->run();
