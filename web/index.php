<?php
use ItForFree\SimpleMVC\Application;
use ItForFree\rusphp\Log\SimpleEchoLog;

require_once("autoload.php"); // автозагрузка классов

//phpinfo(); die();

//$route = \core\mvc\view\Url::getRoute();
//$obj = new \core\Router($route);


$localConfig = require(__DIR__ . '/../application/config/web-local.php');
$config = ItForFree\rusphp\PHP\ArrayLib\Merger::mergeRecursivelyWithReplace(
    require(__DIR__ . '/../application/config/web.php'), 
    $localConfig);

SimpleEchoLog::pre($config);

\ItForFree\SimpleMVC\Application::get()
    ->setConfiguration($config)
    ->run();