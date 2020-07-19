<?php
use ItForFree\rusphp\File\Path;
use ItForFree\SimpleMVC\ExceptionHandler;

function autoload($className)
{
// echo '-- '  . $className;   
    // базовая диретория, которая является корнем автозагрузки
    $exceptionHandler = new ExceptionHandler();
    $baseDir = Path::addToDocumentRoot('..' . DIRECTORY_SEPARATOR);
    
    $className = ltrim($className, '\\');
    $fileName  = '';
    $fileName .= $baseDir;
    $namespace = '';
    
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
     
    //echo $fileName;
    try {
        if(file_exists($fileName)) {
                require_once $fileName;
        } else {
            throw new Exception('goto');
        }
    } catch (Exception $e) {
        $exceptionHandler->displayException($e);
    }

}

// регистрируем функцию автозагрузки
spl_autoload_register('autoload'); 

require_once __DIR__ . '/../vendor/autoload.php';