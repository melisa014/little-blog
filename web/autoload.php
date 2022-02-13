<?php
use ItForFree\rusphp\File\Path;

function autoload($className)
{
// echo '-- '  . $className;   
    // базовая диретория, которая является корнем автозагрузки
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
  
    require $fileName;
}

// регистрируем функцию автозагрузки
spl_autoload_register('autoload'); 

require_once __DIR__ . '/../vendor/autoload.php';