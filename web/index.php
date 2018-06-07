<?php
use ItForFree\SimpleMVC\Application;

require_once("autoload.php"); // автозагрузка классов


$Sess = Sess;

//$route = \core\mvc\view\Url::getRoute();
//$obj = new \core\Router($route);


require(__DIR__ . '/../application/config.php');

$config = ItForFree\rusphp\PHP\ArrayLib\Merger::mergeRecursivelyWithReplace(
        require(__DIR__ . '/../application/config/web.php'), 
        require(__DIR__ . '/../application/config/web-local.php'), $localConfig);

(new yii\web\Application($config))->run();


$App = new Application();
$App->run();